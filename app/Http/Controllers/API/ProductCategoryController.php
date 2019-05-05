<?php

namespace LandMS\Http\Controllers\API;

use LandMS\ProductCategory;
use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;

class ProductCategoryController extends Controller
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
        return ProductCategory::latest()->paginate(10);
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
            'cate_name'  =>  'required|string|max:191',
        ]);

        $cate = ProductCategory::where('cate_name', '=', $request['cate_name'] )->exists();
        if ($cate) {
            return response()->json(['existed' => 'Category\'s name already existed.']);
        } else {
            ProductCategory::create($request->all());
            return response()->json(['success' => 'Category\'s added in successfully.']);
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
        return ProductCategory::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LandMS\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
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
        $category = ProductCategory::findOrFail($id);

        $this->validate($request, [
            'cate_name'  =>  'required|string|max:191',
        ]);

        $cate = ProductCategory::where('cate_name', '=', $request['cate_name'] )->exists();

        if ($category->cate_name == $request['cate_name']) {
            $category->update($request->all());
            return response()->json(['success' => 'Category\'s update in successfully.']);
        } else {
            if ($cate) {
                return response()->json(['existed' => 'Category\'s already existed.']);
            } else {
                $category->update($request->all());
                return response()->json(['success' => 'Category\'s update in successfully.']);
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
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return ['status' => 'Category Deleted'];
    }
}
