<?php

namespace LandMS\Http\Controllers\API;

use LandMS\Income\Type;
use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;

class IncomeTypeController extends Controller
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
        return Type::latest()->paginate(10);
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
            'name'  =>  'required|string|max:45',
        ]);

        $nameType = Type::where('name', '=', $request['name'] )->exists();
        if ($nameType) {
            return response()->json(['existed' => 'Name\'s Type already existed.']);
        } else {
            Type::create($request->all());
            return response()->json(['success' => 'Type added in successfully.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Type::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);

        $this->validate($request, [
            'name'  =>  'required|string|max:45',
        ]);

        $name = Type::where('name', '=', $request['name'] )->exists();

        if ($type->name == $request['name']) {
            $type->update($request->all());
            return response()->json(['success' => 'Type update in successfully.']);
        } else {
            if ($name) {
                return response()->json(['existed' => 'Name\'s Type already existed.']);
            } else {
                $type->update($request->all());
                return response()->json(['success' => 'Type update in successfully.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return ['status' => 'Type Deleted'];
    }
}
