<?php

namespace App\Http\Controllers;
use App\Business;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\LastId;
use App\Meta;

class BusinessController extends Controller
{

    public function index(){
        $business_list = Business::all();
        return view('business.index' , ['business_list' => $business_list ]);
    }

    public function create(){
        $time_slot = ['15' => 15, '30' => 30, '45' => 45, '60' => 60 ];
        $days      = ['default','monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        return view('business.create', [ 'days' => $days, 'time_slot' => $time_slot]);
    }

    public function show(){
        //not in use
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
        /* To save meta record */
        $metaObj = new Meta();
        $metaObj->ref_id = $obj->id;
        $metaObj->ref_name = 'Business';
        $metaObj->meta_details = json_encode(['slot' => request('slot')]);
        $metaObj->save();
        /* end to save meta record */
    	Session::flash('message', 'Successfully Added..!'); 
		Session::flash('alert-class', 'alert-success'); 
    	return redirect()->route('business.index');
    }

    public function edit($business_id){
              
        $business      = Business::find($business_id);
        $services      = $business->services->pluck('id')->toArray();
        $days          = ['default' , 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $working_hours = $business['working_hours'];
        /* to get slot value */
        $time_slot     = ['15' => 15, '30' => 30, '45' => 45, '60' => 60 ];
        $slot = Business::getSlotDetail($business_id , 'Business' );
        /* end to get slot value */
        return view('business.edit', [ 
                                        'business'      => $business , 
                                        'services'      => $services , 
                                        'days'          => $days , 
                                        'working_hours' => $working_hours , 'slot' => $slot,
                                        'time_slot'     => $time_slot,
                                        'slot'          => $slot
                                    ]);
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
        /* to update slot */
        $metaObj = Meta::where(['ref_id'=>$id, 'ref_name' => 'Business'])->first();
        $metaObj->meta_details = json_encode(['slot' => request('slot')]);
        $metaObj->update();
        /* end to update slot */
        Session::flash('message', 'Successfully Updated..!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->route('business.index');
    }//update() ends

    public function destroy($business_id){
        
        $del_business = Business::find($business_id);
        if($del_business->delete()){
            Session::flash('message', 'Successfully Deleted..!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->route('business.index');       
        }
        else{
            Session::flash('message', 'Can not find..!'); 
            Session::flash('alert-class', 'alert-info'); 
            return redirect()->route('business.index');       
        }
    } //destroy() ends 

}

