<?php

namespace LandMS\Http\Controllers\API;

use Illuminate\Http\Request;
use LandMS\Http\Controllers\Controller;
use LandMS\Customer;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Input;
use Storage;

class CustomerController extends Controller
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
        // return Customer::where('type', '=', 'active' )->latest()->paginate(10);
        return response()
            ->json([
                'collection' => Customer::advancedFilter()
            ]);
    }

    public function getCustomers(){
        return Customer::get();
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
            'firstname'  =>  'required|string|max:191',
            'lastname'  =>  'required|string|max:191',
            'dob'   =>  'date|before:today|nullable',
            'type'  =>  'nullable'
        ]);

        $first = Customer::where('firstname', '=', $request['firstname'] )->exists();
        $last = Customer::where('lastname', '=', $request['lastname'] )->exists();

        if ($first && $last) {
            return response()->json(['existed' => 'Customer\'s name already existed.']);
        } else {
            if (empty($request['type'])) {
                $request['type'] = 'active';
            }
            if(Customer::create($request->all())){
                return response()->json(['success' => 'Customer\'s added in successfully.']);
            } else {
                return response()->json(['error' => 'Data can not insert.']);
            }
        }

        // if ($first && $last)   {
        //     return response(['status' => 'Customer already existed!']);
        // } else {      
        //     Customer::create([
        //         'lastname'       =>  $request['lastname'],
        //         'firstname'      =>  $request['firstname'],
        //         'sex'            =>  $request['sex'],
        //         'companyname'    =>  $request['companyname'],
        //         'dob'            =>  $request['dob'],
        //         'type'           =>  $request['type'],
        //         'businessphone'  =>  $request['businessphone'],
        //         'personalphone'  =>  $request['personalphone'],
        //         'fax'            =>  $request['fax'],
        //         'email'          =>  $request['email'],
        //         'website'        =>  $request['website'],
        //         'twitter'        =>  $request['twitter'],
        //         'line'           =>  $request['line'],
        //         'remarkcontact'  =>  $request['remarkcontact'],
        //         'postalcode'     =>  $request['postalcode'],
        //         'street'         =>  $request['street'],
        //         'city'           =>  $request['city'],
        //         'country'        =>  $request['country'],
        //         'remarkaddress'  =>  $request['remarkaddress'],
        //     ]);
        //     return response(['status' => 'Customer added successfully!!']);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
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
        $customer = Customer::findOrFail($id);

        $this->validate($request, [
            'firstname'  =>  'required|string|max:191',
            'lastname'  =>  'required|string|max:191',
            'dob'   =>  'date|before:today|nullable',
            'type'  =>  'nullable'
        ]);

        $first = Customer::where('firstname', '=', $request['firstname'] )->exists();
        $last = Customer::where('lastname', '=', $request['lastname'] )->exists();

        if ($customer->firstname == $request['firstname'] && $customer->lastname == $request['lastname']) {
            $customer->update($request->all());
            // return 'Customer\'s update in successfully.';
            return response()->json(['success' => 'Customer\'s update in successfully.']);
        } else {
            if ($first && $last) {
                return response()->json(['existed' => 'Customer\'s name already existed.']);
            } else {
                $customer->update($request->all());
                // return 'Customer\'s update in successfully...';

                return response()->json(['success' => 'Customer\'s update in successfully.']);
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
        $customer = Customer::findOrFail($id);

        // Delete the user
        $customer->delete();
        return ['status' => 'Customer Deleted'];
    }

    public function searchCustomer() {
        if($search = \Request::get('q')) {
            $customers = Customer::where(function($query) use ($search){
            $query->where('firstname', 'LIKE', "%$search%")
                ->orWhere('lastname', 'LIKE', "%$search%")
                ->orWhere('type', 'LIKE', "%$search%")
                ->orWhere('businessphone', 'LIKE', "%$search%")
                ->orWhere('personalphone', 'LIKE', "%$search%")
                ->orWhere('created_at', 'LIKE', "%$search%");
            })->toJson();
        } else {
            $customers = Customer::latest()->paginate(10);
        }
        return $customers;
    }

    public function avatarUpload(Request $request, $id){
        $customer = Customer::where('id', '=', $id)->first();

        $currentPhoto = $customer->photo;
        if ($request->photo != $currentPhoto) {
            // Convert the name of photo to another unique name
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            // Put the photo to the folder in "public"
            \Image::make($request->photo)->save(public_path('img/customers/'). $customer->id.'/' .$name);

            $request->merge(['photo' => $name]);

            $customerPhoto = public_path('img/customers/'). $customer->id.'/' .$currentPhoto;
            if (file_exists($customerPhoto)) {
                @unlink($customerPhoto);
            }

            Customer::where('id', '=', $id)->update([
                'photo' => $name
            ]);
            return ['status' => 'Updated Customer Profile!!'];
        }
    }
}
