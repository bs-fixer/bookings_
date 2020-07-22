<?php

namespace App\Http\Controllers;
use App\Business;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class BusinessController extends Controller
{

    public function index(){
        $business_list = Business::all();
        return view('business.business' , ['business_list' => $business_list ]);
    }

    public function create($page = 'configuration'){
        
        if($page == 'addBusiness'){
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            return view('business.generalized', [ 'days' => $days]);
        }
        else if( $page == 'configuration'){
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        	return view('business.configuration', [ 'days' => $days]);
        }
        else{
            abort('402');
        }
    }

    public function store(){	
        
        $validate = request()->validate(
            [
                'title'        => 'required|min:8',
                'description'  => 'required',
                'working_days' => 'nullable|array',
                'working_hours'=> 'required|array',
                'working_hours.*.to.*'   => 'nullable|date_format:H:i',
                'working_hours.*.from.*' => 'nullable|date_format:H:i'
            ]
        );
        
        // if ( $validate->fails() ) {
        //     return redirect()->back()->withInput();
        // }

        $keeper = [];
        foreach($validate['working_hours'] as $day => $hours ){
            
            foreach($validate['working_hours'][$day]['to'] as $i => $to){
                $keeper[$day][$i]['to']    = $to;
                $keeper[$day][$i]['from']  = $validate['working_hours'][$day]['from'][$i];
            }    
        }

        $validate['working_hours'] = $keeper;
        $obj  = new Business($validate);
        $obj->save();
    	Session::flash('message', 'Successfully Added..!'); 
		Session::flash('alert-class', 'alert-success'); 
    	return redirect()->route('configuration');
    }

    public function edit($business_id){
        $business      = Business::find($business_id);
        $services      = $business->services->pluck('id')->toArray();
        $days          = ['default' , 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $working_hours = $business['working_hours'];
        return view('business.edit', [ 'business' => $business , 'services' => $services , 'days' => $days , 'working_hours' => $working_hours]);
    } //edit() ends

    public function update($id){
        $business      = Business::find($id);
        $validate      = request()->validate(
            [
                'title'        => 'required|min:8',
                'description'  => 'required',
                'working_days' => 'nullable|array',
                'working_hours'=> 'required|array',
                'working_hours.*.to.*'   => 'nullable|date_format:H:i',
                'working_hours.*.from.*' => 'nullable|date_format:H:i'
            ]
        );

        $keeper = [];
        foreach($validate['working_hours'] as $day => $hours ){
            
            foreach($validate['working_hours'][$day]['to'] as $i => $to){
                $keeper[$day][$i]['to']    = $to;
                $keeper[$day][$i]['from']  = $validate['working_hours'][$day]['from'][$i];
            }    
        }
        $validate['working_hours'] = $keeper;
        $business->update($validate);

        Session::flash('message', 'Successfully Updated..!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->route('Business');
    }//update() ends

    public function destroy($business_id){
        
        $del_business = Business::find($business_id);
        if($del_business->delete()){
            Session::flash('message', 'Successfully Deleted..!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->route('Business');       
        }
        else{
            Session::flash('message', 'Can not find..!'); 
            Session::flash('alert-class', 'alert-info'); 
            return redirect()->route('Business');       
        }
    } //destroy() ends 

}

