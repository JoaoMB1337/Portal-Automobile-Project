<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use Illuminate\Http\Request;


class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $insurance = Insurance::orderby('id','asc')->paginate(15);
        return view('pages.insurance.list',['insurance'=>$insurance]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.insurance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsuranceRequest $request)
    {


        $insurance = new Insurance();

        $insurance->insurance_company = $request->insurance_company;
        $insurance->policy_number = $request->policy_number;
        $insurance->start_date = $request->start_date;
        $insurance->end_date = $request->end_date;
        $insurance->cost = $request->cost;
        $insurance->vehicle_id = $request->vehicle_id;

        $insurance->save();

        return redirect()->route('insurances.index')->with('success', 'Insurance created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance)
    {
        //
        return view('pages.insurance.show', compact('insurance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurance $insurance)
    {
        //
        return view('pages.insurance.edit', compact('insurance'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insurance $insurance)
    {
        $request->validate([
            'insurance_company' => 'required|string',
            'policy_number' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'cost' => 'required|numeric',
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);

        $insurance->update($request->all());

        return redirect()->route('insurances.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance)
    {
        //
        $insurance->delete();
        return redirect()->route('insurances.index');
    }

    public function deleteSelected(Request $request)
    {
        $selected_ids = json_decode($request->input('selected_ids'),true);
        if(!empty($selected_ids)) {
            Insurance::whereIn('id', $selected_ids)->delete();
            return redirect()->route('insurances.index');
        }
    }
}
