<?php

namespace App\Http\Controllers;

use App\Models\IdentityCard;
use Illuminate\Http\Request;

class IdentityCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identityCards = IdentityCard::latest()->paginate(5);
    
        return view('identityCards.index',compact('identityCards'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentityCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentityCard  $identityCard
     * @return \Illuminate\Http\Response
     */
    public function show(IdentityCard $identityCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentityCard  $identityCard
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentityCard $identityCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentityCard  $identityCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentityCard $identityCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentityCard  $identityCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentityCard $identityCard)
    {
        //
    }
}
