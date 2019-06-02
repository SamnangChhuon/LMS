<?php

namespace LandMS\Http\Controllers\API;

use LandMS\Income\Income;
use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;

class IncomeController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Income::latest()->paginate(10);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_id'  =>  'required',
            'income_type_id' =>  'required',
            'income_date' =>  'required',
            'amount' =>  'required|numeric|max:16',
        ]);

        Income::create($request->all());
        return to_json(['success' => 'Income added in successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \LandMS\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        return Income::find($income);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LandMS\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \LandMS\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $income = Income::findOrFail($income);

        $this->validate($request, [
            'payment_id'  =>  'required',
            'income_type_id' =>  'required',
            'income_date' =>  'required',
            'amount' =>  'required|numeric|max:16',
        ]);

        $income->update($request->all());
        return to_json(['success' => 'Income update in successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LandMS\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
