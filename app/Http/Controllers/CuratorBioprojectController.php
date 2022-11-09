<?php

namespace App\Http\Controllers;

use App\Models\Bioproject;
use App\Models\Datatype;
use Illuminate\Http\Request;

class CuratorBioprojectController extends Controller
{
    //
    public function index()
    {
        //
        return view('dashboard.curator.index_bioprojects', [
            'title' => 'Bioproject',
            'bioprojects' => Bioproject::with(['organism'])->where('published_at', null)->paginate(5),
        ]);
    }
    public function edit(Bioproject $bioproject)
    {
        $pubs = $bioproject->publication()->get();
        $grants = $bioproject->grant()->get();
        $id_data_type = explode(',', $bioproject->getAttribute('data_type_id'));
        $data_types = Datatype::whereIn('id', $id_data_type)->pluck('name');
        return view('dashboard.curator.show_bioproject', [
            'title' => 'Bioproject',
            'bioproject' => $bioproject,
            'pubs' => $pubs,
            'grants' => $grants,
            'data_types' => $data_types
        ]);
    }
}
