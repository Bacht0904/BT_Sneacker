<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\SlideDetail;
use App\Http\Requests\StoreSlideDetailRequest;
use App\Http\Requests\UpdateSlideDetailRequest;

class SlideDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSlideDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlideDetail  $slideDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SlideDetail $slideDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlideDetail  $slideDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SlideDetail $slideDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSlideDetailRequest  $request
     * @param  \App\Models\SlideDetail  $slideDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideDetailRequest $request, SlideDetail $slideDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlideDetail  $slideDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlideDetail $slideDetail)
    {
        //
    }
}
