<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\HttpException;
use GuzzleHttp\Psr7\Header;
use GuzzleHttp\Client as ClientGuzzle;
use App\Models\OauthAccessToken;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SsoService
{

    public function __construct()
    {
    }

    public static function check()
    {
        $token = session('is_login_baladeva');
        $user = Cache::get($token);

        return isset($user) ? true : false;
    }
    // public static function guest()
    // {
    //     $token = session('is_login_inna_repo');
    //     $user = Cache::get($token);

    //     return ($user->role == 'ADMIN') ? false : true;
    // }

    public static function token()
    {
        $token = session('is_login_inna_repo');
        return $token;
    }
    public static function refreshToken()
    {
        $token = session('is_login_inna_repo');
        $user = Cache::get($token);
        return $user->refresh_token;
    }

    // public static function is_admin()
    // {
    //     $token = session('is_login_inna_repo');
    //     $user = Cache::get($token);

    //     return ($user->role == 'ADMIN') ? true : false;
    // }

    // public static function id()
    // {
    //     $token = session('token_login');
    //     $user = Cache::get($token);
    //     return $user->usernameintra ?? null::logout();
    // }

    private function provider()
    {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => env('OAUTH2_CLIENT_ID'),
            'clientSecret' => env('OAUTH2_CLIENT_SECRET'),
            'redirectUri' => env('OAUTH2_REDIRECT_URI'),
            'urlAccessToken' => env('OAUTH2_URL_ACCESSTOKEN'),
            'urlAuthorize' => env('OAUTH2_URL_AUTHORIZE'),
            'urlResourceOwnerDetails' => env('OAUTH2_URL_RESOURCE_OWNER')
        ]);
        return $provider;
    }

    public function getAccessToken(Request $request)
    {
        $provider = $this->provider();
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $request->code
        ]);
        return $accessToken;
    }

    public function getAuthenticatedRequest($method, $url, $accessToken, $options)
    {
        $provider = $this->provider();
        $request = $provider->getAuthenticatedRequest(
            $method,
            $url,
            $accessToken,
            $options
        );
        return $request;
    }

    public function getParsedResponse($request)
    {
        $provider = $this->provider();
        $response = $provider->getParsedResponse($request);
        return $response;
    }

    public function authorize(Request $request)
    {

        $provider = $this->provider();
        // dd($provider);
        if (!isset($request->code)) {
            // dd('tidak ada code');
            $authUrl = $provider->getAuthorizationUrl();

            session(['oauth2state' => $provider->getState()]);
            // dd($request);
            return $authUrl;
            exit;

            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($request->state) || ($request->state !== $request->session()->get('oauth2state'))) {

            $request->session()->forget('oauth2state');
            exit('Invalid state');
        } else {
            // dd($request->code);
            // Try to get an access token (using the authorization code grant)
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $request->code
            ]);
            // dd($accessToken);
            session(['brin_sso_access_token' => $accessToken]);
            $options['headers']['content-type'] = 'application/json';
            // Optional: Now you have a token you can look up a users profile data
            try {
                $requests = $provider->getAuthenticatedRequest(
                    'GET',
                    env('API_SSO') . 'user/me',
                    $accessToken,
                    $options
                );
                $response = $provider->getParsedResponse($requests);
                $response = json_decode(json_encode($response));
                // dd($response);
                $this->loginsso($request, $response, $accessToken);
            } catch (Exception $e) {
                echo $e->getMessage();
                // Failed to get user details
                exit('Ups...contact your system administrator.');
            }
        }
    }
    // Store to Login SSO
    public function loginsso(Request $request, $response, $accessToken)
    {
        // dd($response);
        try {
            $result = new \stdClass();

            $tokens = $accessToken->getToken();
            $refreshtoken = $accessToken->getRefreshToken();
            if ($response->userData->active == 0) {
                throw new Exception('Akun Belum Aktivasi, Silahkan cek email anda untuk melakukan aktivasi akun');
            }

            // Cek Userename udah ada apa Belum? kalo udah Insert, kalo belom Update refresh Token
            $result = User::where('username', $response->userData->username)->first();
            // dd($result);
            if ($result) {
                // Update
                // dd($result);
                try {
                    $result->access_token = $tokens;
                    $result->refresh_token = $refreshtoken;
                    $result->expired_at = $accessToken->getExpires();
                    $result->is_activated = $response->userData->active;
                    $result->update();
                } catch (\Exception $e) {
                    // do task when error
                    $e->getMessage();   // insert query
                }
            } else {
                try {
                    $newData = new User();
                    $newData->user_id = $request->session()->get('brin_sso_access_token');
                    $newData->username = $response->userData->username;
                    $newData->name = $response->userData->first_name;
                    $newData->email = $response->userData->email;
                    // $newData->email_verified_at = $request->username;
                    $newData->administrative = $response->pegawaiData->administrative_unit_id;
                    $newData->affiliate = $response->pegawaiData->affiliate_unit_id;
                    $newData->remember_token = $tokens;
                    $newData->external_account = $response->userData->external_account;
                    $newData->is_activated = $response->userData->active;
                    $newData->access_token = $tokens;
                    $newData->refresh_token = $refreshtoken;
                    $newData->expired_at = Carbon::createFromTimestamp($accessToken->getExpires());
                    $newData->user_data = json_encode($response);
                    $newData->created_at = Carbon::now();
                    // dd($newData);
                    $newData->save();
                    //@gelar
                    $result = $newData;
                    //End @gelar
                } catch (\Exception $e) {
                    // do task when error
                    $e->getMessage();   // insert query
                }
            }

            Cache::add($tokens, $result, 3600);
            session(['is_login_inna_repo' => $tokens]);
            session([$tokens => $result]);
            //@gelar      
            Auth::login($result);
            //End @gelar
            // dd("test sso service");
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAuthUserSso($token)
    {
        $guzzle = new ClientGuzzle();

        $response = $guzzle->get(env('API_SSO') . 'user/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ],
            'form_params' => []
        ]);

        return $response;
    }



    public function logout(Request $request)
    {
        // $token = $this->token();
        // dd($token);
        // dd(session());

        // $accessToken = OauthAccessToken::where('id', $token)->first();

        // if (!$accessToken) {
        //     return redirect(route('admin.login'));
        // } else {
        //     $accessToken->delete();
        //     Cache::forget($token);
        //     $sessFlus = session()->flush();
        //     return redirect(route('admin.login'));
        // }
        // dd($token);
        // dd(Cache::get($token));
        // Cache::flush();

        // Cache::forget($token);
        $request->session()->forget('brin_sso_access_token');
        $request->session()->forget('is_login_inna_repo');
        $request->session()->flush();
        $request->session()->regenerate();
        $request->session()->invalidate();

        //@gelar
        Auth::logout();
        Session::flush();
        //End @gelar

        // sso.brin.go.id/logout?redirect_uri=https://inna-prototype.brin.go.id/
        // OAUTH2_REDIRECT_URI=https://inna-prototype.brin.go.id/
        $home = env('APP_URL');
        $url = env('URL_LOGOUT');
        return redirect($url . $home);
    }
}
