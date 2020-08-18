<?php

namespace App\Http\Controllers;
use App\Business;
use App\Meta;
use App\Booking;
use Session;
use Illuminate\Http\Request;

class FrontendBookingController extends Controller
{
    public function create($business_id){
        $employees = Business::find($business_id)
                ->employees
                ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                ->pluck('name','id');

        $services = Business::find($business_id)
                ->services
                ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                ->pluck('name', 'id');
        $working_days = Business::find($business_id)->employees->pluck('working_hours');
        return view('frontend.booking', ['business_id' => $business_id , 'employees' => $employees , 'services' => $services]);
    } //function ends 

    public function store($business_id){
        
        $slot       = Meta::where(['ref_id' => request('ref_id'), 'ref_name' => 'Employee'])->pluck('value')->first();
        $slot_index = request('slot_index');
        
        $obj        = new Booking(request(['business_id','ref_id']));
        $obj->business_id = request('business_id');
        $obj->ref_id   = request('ref_id');
        $obj->ref_name = 'Employee';
        $obj->details  = json_encode([
                                        'services' => request()->services , 
                                        'slot' => $slot, 
                                        'name' => request('name'),
                                        'email'=> request('email'),
                                        'contact' => request('contact')
                                    ]);
        $obj->date     = request('dob');
        $obj->slot     = $slot_index;
        $obj->save();
        return response()->json(['success']);
    	// Session::flash('message', 'Successfully Added..!'); 
		// Session::flash('alert-class', 'alert-success'); 
    	// return redirect()->route('business.bookings.index', $business_id);
    }// bookingCreate() ends

}
