<?php

namespace LandMS\Http\Controllers\API;

use LandMS\Product;
use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;
use LandMS\Promotion;

class ProductController extends Controller
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
        return response()
            ->json([
                'collection' => Product::advancedFilter()
            ]);
    }

    public function getProducts()
    {
        return Product::get();
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
            'name'  =>  'required|string|max:191',
            'price' =>  'required|numeric|max:16'
        ]);

        if ($request->cid != '') {
            Product::create($request->all());
            return response()->json(['success' => 'Product\'s added in successfully.']);
        } else {
            return response()->json(['error' => 'Product\'s can not insert.']);
        }

        // $name = Product::where('name', '=', $request['name'] )->exists();
        // if ($name) {
        //     return response()->json(['existed' => 'Product\'s name already existed.']);
        // } else {
        //     if ($request['image']) {
        //         $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        //         // Put the photo to the folder in "public"
        //         \Image::make($request->image)->save(public_path('img/products/').$name);
    
        //         $request->merge(['image' => $name]);
        //     }
        //     Product::create($request->all());
        //     return response()->json(['success' => 'Product\'s added in successfully.']);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \LandMS\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Product::where('cid', '=', $product['id'] )->get();
    }

    public function getProduct(Product $product){
        return Product::where('id', '=', $product['id'] )->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LandMS\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \LandMS\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($product);

        $this->validate($request, [
            'name'  =>  'required|string|max:191',
        ]);

        // if ($request->file != null) {
        //     $name = time() . '.' . explode('/', explode(':', substr($request->file, 0, strpos($request->file, ';')))[1])[1];
        //     // Put the photo to the folder in "public"
        //     \Image::make($request->file)->save(public_path('img/products/').$name);

        //     $request->merge(['image' => $name]);

        //     $userPhoto = public_path('img/products/').$currentPhoto;
        //     if (file_exists($userPhoto)) {
        //         @unlink($userPhoto);
        //     }
        // }

        $name = Product::where('name', '=', $request['name'] )->exists();

        if ($product->name == $request['name']) {
            $product->update($request->all());
            return response()->json(['success' => 'Product\'s update in successfully.']);
        } else {
            if ($name) {
                return response()->json(['existed' => 'Product\'s name already existed.']);
            } else {
                $product->update($request->all());
                return response()->json(['success' => 'Product\'s update in successfully.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LandMS\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return ['status' => 'Product Deleted'];
    }
}
