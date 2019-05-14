<?php

namespace LandMS\Http\Controllers\API;

use LandMS\ProductType;
use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;

class ProductTypeController extends Controller
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
        return ProductType::latest()->paginate(10);
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
            'type_name'  =>  'required|string|max:191',
        ]);

        $type = ProductType::where('type_name', '=', $request['type_name'] )->exists();
        if ($type) {
            return response()->json(['existed' => 'Type\'s already existed.']);
        } else {
            ProductType::create($request->all());
            return response()->json(['success' => 'Type\'s added in successfully.']);
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
        return ProductType::where('id', '=', $id )->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LandMS\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
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
        $type = ProductType::findOrFail($id);

        $this->validate($request, [
            'type_name'  =>  'required|string|max:191',
        ]);

        $typeName = ProductType::where('type_name', '=', $request['type_name'] )->exists();

        if ($type->type_name == $request['type_name']) {
            $type->update($request->all());
            return response()->json(['success' => 'Type\'s update in successfully.']);
        } else {
            if ($typeName) {
                return response()->json(['existed' => 'Type\'s already existed.']);
            } else {
                $type->update($request->all());
                return response()->json(['success' => 'Type\'s update in successfully.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LandMS\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = ProductType::findOrFail($id);
        $type->delete();
        return ['status' => 'Type Deleted'];
    }
}
