<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use Illuminate\Http\Request;
use App\Models\Bioproject;
use App\Models\Biosample;
use Illuminate\Support\Facades\Cache;

use App\Services\SsoService;


class DashboardIndexController extends Controller
{
    //
    public function index(Request $request)
    {
        // // $code = Cache::get('code');
        // // dd($code);
        // $allSessions = session()->get('brin_sso_access_token');
        // $allSessions = session()->all();
        // $ssoService = new SsoService();
        // $ssotoken = $ssoService->getAccessToken($request);
        // dd($allSessions);
        // // dd($allSessions['brin_sso_access_token']);

        // session(['brin_sso_access_token' => $ssotoken]);
        // $options['headers']['content-type'] = 'application/json';
        // // // Optional: Now you have a token you can look up a users profile data
        // try {
        //     $requests = $ssoService->getAuthenticatedRequest(
        //         'GET',
        //         env('API_SSO') . 'user/me',
        //         $ssotoken,
        //         $options
        //     );
        //     $response = $ssoService->getParsedResponse($requests);
        //     $response = json_decode(json_encode($response));
        //     dd($response);
        //     // $this->loginsso($request, $response, $accessToken);
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        //     // Failed to get user details
        //     exit('Ups...contact your system administrator.');
        // }
        // // $data = $ssoService->authorize($request);
        // dd($allSessions);
        // $tokens = $accessToken->getToken();
        // dd($tokens);
        // dd($request->state);
        // dd($allSessions);

        // dd($allSessions);

        // dd($data_in_concern);
        // $userID= auth()->user()->id;
        // $userID = $response->pegawaiData->id;
        // $nama = $response->pegawaiData->name;
        // $options['headers']['content-type'] = 'application/json';
        // $userSSO = $ssoService->getAuthUserSso(session(['brin_sso_access_token']));
        // dd($userSSO);
        $userID = null;
        $nama = null;
        $token = session('is_login_inna_repo');
        if (Cache::has($token)) {
            $Auth = Cache::get($token);
            // dd($Auth);
            $userID = $Auth['id'];
            $nama = $Auth['name'];
            // return $Auth;
            // return redirect()->action([DashboardIndexController::class, 'index']);
        }

        $bioproject = Bioproject::where('user_id', $userID)->get();
        $bioproject_count = $bioproject->count();
        $bioproject_pub = Bioproject::where(
            'user_id',
            $userID
        )->where(
            'status',
            5
        )->get();
        $bioproject_pub_count = $bioproject_pub->count();

        $biosample = Biosample::where(
                'user_id',
                $userID
            )->get();
        $biosample_count = $biosample->count();
        $biosample_pub = Biosample::where('user_id',
            $userID
        )->where(
            'status',
            5
        )->get();
        $biosample_pub_count = $biosample_pub->count();

        $bioarchive = Bioarchive::where('user_id', $userID)->get();
        $bioarchive_count = $bioarchive->count();
        $bioarchive_pub = Bioarchive::where(
            'user_id',
            $userID
        )->where(
            'status',
            5
        )->get();
        $bioarchive_pub_count = $bioarchive_pub->count();

        return view('dashboard.index', [
            'bioproject_count' => $bioproject_count,
            'bioproject_pub_count' => $bioproject_pub_count,

            'biosample_count' => $biosample_count,
            'biosample_pub_count' => $biosample_pub_count,

            'bioarchive_count' => $bioarchive_count,
            'bioarchive_pub_count' => $bioarchive_pub_count,

            'nama' => $nama,

        ]);
    }
}
