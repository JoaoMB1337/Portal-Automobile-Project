<?php

namespace App\Http\Controllers;

use App\Models\CostType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCostTypeRequest;
use App\Http\Requests\UpdateCostTypeRequest;


class CostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCostTypeRequest $request)
    {

       }

    /**
     * Display the specified resource.
     */
    public function show(CostType $costType)
    {

        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostType $costType)
    {
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostTypeRequest $request, CostType $costType)
    {
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostType $costType)
    {
       
    }

    
}