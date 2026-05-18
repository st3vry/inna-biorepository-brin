<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bioarchive;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\Bioproject;
use App\Models\Biosample;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Services\SsoService;


class DashboardIndexController extends Controller
{
    // Get array of monthly counts [jan, feb, mar, ..., dec]
    private function getMonthlyCount($model, $userID, $year = 0)
    {
        $counts = array_fill(0, 12, 0);
        
        if ($year == 0) {
            $data = $model->where('user_id',$userID)      
                ->selectRaw('EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as count')
                ->groupBy(DB::raw('bulan'))
                ->get();
        } else {
            $data = $model->where('user_id',$userID)  
                ->whereYear('created_at', $year)    
                ->selectRaw('EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as count')
                ->groupBy(DB::raw('bulan'))
                ->get();
        }
        foreach ($data as $row) {
            $counts[$row->bulan - 1] = $row->count;
        }

        return $counts;
    }

    public function getOverviewChartData(Request $request)
    {
        $userID = auth()->id();
        $nama = auth()->user()->name;

        $year = $request->year ?? Carbon::now()->year;
        $bioprojects = $this->getMonthlyCount(new Bioproject(), $userID, $year);
        $biosamples = $this->getMonthlyCount(new Biosample(), $userID, $year);
        $bioarchives = $this->getMonthlyCount(new Bioarchive(), $userID, $year);
        $total = array_map(function ($a, $b, $c) {
            return $a + $b + $c;
        }, $bioprojects, $biosamples, $bioarchives);

        return response()->json([
            'bioproject' => $bioprojects,
            'biosample' => $biosamples,
            'bioarchive' => $bioarchives,
            'total' => $total,
        ]);
    }

    //
    public function index(Request $request)
    {
        $userID = auth()->id();
        $nama = auth()->user()->name;
        $year = 0;

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
        $bioproject_hold = Bioproject::where(
            'user_id',
            $userID
        )->where(
            ['status' => 5,
            'hold_release' => true]
        )->get();
        $bioproject_hold_count = $bioproject_hold->count();

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
        $biosample_hold = Biosample::where(
            'user_id',
            $userID
        )->where(
            ['status' => 5,
            'hold_release' => true]
        )->get();
        $biosample_hold_count = $biosample_hold->count();

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
        $bioarchive_hold = Bioarchive::where(
            'user_id',
            $userID
        )->where(
            ['status' => 5,
            'hold_release' => true]
        )->get();
        $bioarchive_hold_count = $bioarchive_hold->count();

        $bioproject_overview = $this->getMonthlyCount(new Bioproject(), $userID, $year);
        $biosample_overview = $this->getMonthlyCount(new Biosample(), $userID, $year);
        $bioarchive_overview = $this->getMonthlyCount(new Bioarchive(), $userID, $year);
        $total_overview = array_map(function ($a, $b, $c) {
            return $a + $b + $c;
        }, $bioproject_overview, $biosample_overview, $bioarchive_overview);

        return view('dashboard.index', [
            'bioproject_count' => $bioproject_count,
            'bioproject_pub_count' => $bioproject_pub_count,
            'bioproject_hold_count' => $bioproject_hold_count,
            'bioproject_overview' => $bioproject_overview,

            'biosample_count' => $biosample_count,
            'biosample_pub_count' => $biosample_pub_count,
            'biosample_hold_count' => $biosample_hold_count,
            'biosample_overview' => $biosample_overview,

            'bioarchive_count' => $bioarchive_count,
            'bioarchive_pub_count' => $bioarchive_pub_count,
            'bioarchive_hold_count' => $bioarchive_hold_count,
            'bioarchive_overview' => $bioarchive_overview,

            'nama' => $nama,
            'total_overview' => $total_overview,

        ]);
    }
}
