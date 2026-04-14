<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        return view('dashboard.affiliate.index', [
            'affiliates' => Affiliate::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.affiliate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'website' => ''
        ]);

        Affiliate::create($validatedData);
        return redirect('/dashboard/affiliates')->with('success', 'Affiliate created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function show(Affiliate $affiliate)
    {
        return view('dashboard.affiliate.show', [
            'affiliate' => $affiliate
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function edit(Affiliate $affiliate)
    {
        return view('dashboard.affiliate.edit', [
            'affiliate' => $affiliate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affiliate $affiliate)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'website' => ''
        ]);

        Affiliate::where('id', $affiliate->id)->update($validatedData);
        return redirect('/dashboard/affiliates')->with('success', 'Affiliate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affiliate $affiliate)
    {
        Affiliate::destroy($affiliate->id);
        return redirect('/dashboard/affiliates')->with('success', 'Affiliate deleted successfully!');
    }
}
