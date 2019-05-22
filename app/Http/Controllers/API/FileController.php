<?php

namespace LandMS\Http\Controllers\API;

use LandMS\File;
use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;

class FileController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'file' => 'required',
        //     // 'file.*' => 'mimes:doc,pdf,docx,zip'
        //     'file.*' => 'image|mimes:png,jpg,jpeg,webp,gif'
        // ]);
        return response()->json(['success' => $request['file']]);

        if ($request['file']) {
            // $file = File::create($request->all());
            foreach ($request->file('file') as $file) {
                $filename = $file->store('img');
                File::create([
                    'cid' => $request['cid'],
                    'file' => $filename
                ]);
            }
            return response()->json(['success' => 'File added in successfully.']);
        }

        // if ($request->hasfile('file')) {
        //     $file = File::create($request->all());
        //     foreach ($request->file as $fi) {
        //         $filename = $fi->store('file');
        //         ProductsPhoto::create([
        //             'cid' => $product->id,
        //             'filename' => $filename
        //         ]);
        //     }
        // }

        // if($request->hasfile('file'))
        // {
        //     foreach($request->file('file') as $file)
        //     {
        //         $name = $file->getClientOriginalName();
        //         $file->move(public_path().'/img/', $name);  
        //         $data[] = $name;  
        //     }
        // }

        // $file = new File();
        // $file->file = json_encode($data);
        // $file->save();
    }
    public function storeFileById(Request $request, $cid){
        // $files = $request->file('files');

        $files = $request->file;
        $int = 0;
        if ($files) {
            foreach($files as $file){
                $filename = $file['name']->getClientOriginalName();
                $filename = time() . '.' . $file['name'];
                $file->storeAs('/customers/img/' . $cid , $filename);
                File::create([
                    'cid' => $cid,
                    'file' => $filename
                ]);
                $int++;
                return response()->json(['result', $file['name']]);

            }

        }


        // if ($files) {
        //     foreach($files as $file){
        //         $filename = $file['name']->getClientOriginalName();
        //         $file->storeAs('/customers/img/' . $cid , $filename);
        //         File::create([
        //             'cid' => $cid,
        //             'file' => $filename
        //         ]);
        //     }
        //     return response()->json(['success' => 'File added in successfully.']);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \LandMS\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return File::where('cid', '=', $file->cid )->get();
    }
    public function showFile($id)
    {
        return File::where('cid', '=', $id )->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LandMS\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \LandMS\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LandMS\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
