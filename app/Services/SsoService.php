<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\HttpException;
use GuzzleHttp\Psr7\Header;
use GuzzleHttp\Client as ClientGuzzle;
use App\Models\OauthAccessToken;
use Illuminate\Support\Carbon;

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

    public function authorize(Request $request)
    {

        $provider = $this->provider();
        //dd($request->code);
        if (!isset($request->code)) {
            //dd('tidak ada code');
            $authUrl = $provider->getAuthorizationUrl();

            session(['oauth2state' => $provider->getState()]);
            return $authUrl;
            exit;

            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($request->state) || ($request->state !== $request->session()->get('oauth2state'))) {

            $request->session()->forget('oauth2state');
            exit('Invalid state');
        } else {
            //dd('aam autorize');
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
            // Store to Oauth Access token;
            $token = new OauthAccessToken();
            $token->id = $request->session()->get('brin_sso_access_token');
            $token->username = $response->userData->username;
            $token->expires_at = Carbon::createFromTimestamp($accessToken->getExpires());
            $token->user_data = json_encode($response);
            $token->created_at = Carbon::now();
            $token->save();

            // Cek Userename udah ada apa Belum? kalo udah Insert, kalo belom Update refresh Token
            // $result = User::where('usernameintra', $response->userData->username)->first();
            // dd($result);
            if ($result) {
                // Update
                $result->access_token = $tokens;
                $result->refresh_token = $refreshtoken;
                $result->expired = $accessToken->getExpires();
                $result->active = $response->userData->active;
                $result->save();
            } else {
                // Insert
                $newData = new \stdClass();
                $newData->name = $response->userData->first_name;
                $newData->email = $response->userData->email;
                $newData->email_verified_at = $request->username;
                $newData->remember_token = $tokens;
                $newData->usernameintra = $response->userData->username;
                $newData->external_account = $response->userData->external_account;
                $newData->active = $response->userData->active;
                $newData->access_token = $tokens;
                $newData->refresh_token = $refreshtoken;
                $newData->expired = $accessToken->getExpires();

                if ($response->userData->external_account != '1') {
                    // Sivitas BRIN
                    $newData->instansi = 'Badan Riset dan Inovasi Nasional';
                    if ($response->userData->username == 'farh001') {
                        $newData->role = 'ADMIN';
                    } else {
                        $newData->role = 'GUEST';
                    }
                } else {
                    // Sivitas Non BRIN
                    $newData->instansi = '';
                    $newData->role = 'GUEST';
                }
                $result = $this->userService->saveUser($newData);
                // dd($result);
            }

            Cache::add($tokens, $result, 3600);
            session(['is_login_inna_repo' => $tokens]);
            session([$tokens => $result]);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAuthUserSso(string $token)
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



    public function logout()
    {
        $token = $this->token();

        // $accessToken = OauthAccessToken::where('id', $token)->first();

        // if (!$accessToken){
        //     return redirect(route('admin.login'));
        // }else{
        //     $accessToken->delete();
        //     Cache::forget($token);
        //     $sessFlus = session()->flush();
        //     return redirect(route('admin.login'));
        // }


        Cache::forget($token);
        $sessFlus = session()->flush();
        // return redirect(route('admin.login'));
        return redirect('/');
    }
}
