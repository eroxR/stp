<?php

namespace App\Http\Controllers;

use App\Models\Pension;
use App\Http\Requests\StorePensionRequest;
use App\Http\Requests\UpdatePensionRequest;

class PensionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePensionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pension $pension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pension $pension)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePensionRequest $request, Pension $pension)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pension $pension)
    {
        //
    }
}
