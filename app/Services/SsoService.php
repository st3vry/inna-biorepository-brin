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
        if (!isset($request->code)) {
            $authUrl = $provider->getAuthorizationUrl();

            session(['oauth2state' => $provider->getState()]);
            return $authUrl;
            exit;

            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($request->state) || ($request->state !== $request->session()->get('oauth2state'))) {

            $request->session()->forget('oauth2state');
            exit('Invalid state');
        } else {
            // Try to get an access token (using the authorization code grant)
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $request->code
            ]);
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
        try {
            $result = new \stdClass();

            $tokens = $accessToken->getToken();
            $refreshtoken = $accessToken->getRefreshToken();
            if ($response->userData->active == 0) {
                throw new Exception('Akun Belum Aktivasi, Silahkan cek email anda untuk melakukan aktivasi akun');
            }

            // Cek Userename udah ada apa Belum? kalo udah Insert, kalo belom Update refresh Token
            $result = User::where('username', $response->userData->username)->first();
            if ($result) {
                // Update
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
                    $newData->administrative = $response->pegawaiData->administrative_unit_id ?? null;
                    $newData->affiliate = $response->pegawaiData->affiliate_unit_id ?? null;
                    $newData->remember_token = $tokens;
                    $newData->external_account = $response->userData->external_account;
                    $newData->is_activated = $response->userData->active;
                    $newData->access_token = $tokens;
                    $newData->refresh_token = $refreshtoken;
                    $newData->expired_at = Carbon::createFromTimestamp($accessToken->getExpires());
                    $newData->user_data = json_encode($response);
                    $newData->created_at = Carbon::now();
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
        $request->session()->forget('brin_sso_access_token');
        $request->session()->forget('is_login_inna_repo');
        $request->session()->flush();
        $request->session()->regenerate();
        $request->session()->invalidate();

        //@gelar
        Auth::logout();
        Session::flush();
        $home = env('APP_URL');
        $url = env('URL_LOGOUT');
        return redirect($url . $home);
    }
}
