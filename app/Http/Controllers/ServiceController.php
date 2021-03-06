<?php

namespace App\Http\Controllers;

use App\Business;
use App\Service;
use Illuminate\Http\Request;
use Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $business = Business::find($id);
        $business->services;
        return view('service.index' , [ 'services' => $business['services'] , 'business_id' => $id ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($business_id)
    {   
        return view('service.create',['business_id' => $business_id ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $validate = $request->validate([
            'business_id' => 'required',
            'name'        => 'required'
        ]);
        $serviceObj = new Service($validate);
        $serviceObj->save();
        Session::flash('message', 'Successfully Added..!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->route('business.service.index',['business_id' => request('business_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($business_id , $service_id)
    {
        $service = Service::find($service_id);
        return view('service.edit' , ['service' => $service , 'business_id' => $business_id ,'service_id' => $service_id ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update($business_id , $service_id )
    {
        $service = Service::find($service_id);
        $service->name = request('name');
        $service->update();
        
        Session::flash('message', 'Successfully Updated..!'); 
        Session::flash('alert-class', 'alert-success'); 
        // return redirect()->route('business.service.index' , ['business_id' => $business_id , 'service_id' => $service_id ]);
        return redirect()->route('business.service.index' , ['business_id' => $business_id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_id , $service_id )
    {   
        $service  = Service::find($service_id);
        $business = $service->business['id'];
        if( $business_id  == $business ){
            $service->delete();
            return redirect()->route('business.service.index', ['business_id' => $business_id]);
        }
        return $service;
        
    }
}
