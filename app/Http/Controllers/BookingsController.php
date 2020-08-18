<?php

namespace App\Http\Controllers;
use App\Business;
use App\Booking;
use App\Meta;
use Session;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /* Bookings STRUCTRUR */
    //details instead of booking_details
    //date
    //slot

    /* META TABLE STRUCTRE */
    //add 2 fields 'key', 'value' instead of meta_details.

    public function index($business_id){
        $booking  = Booking::all();
        $name = [];
        foreach($booking as $bl ){
            $ref_name  = $bl->object();
            $name[]    = $ref_name->name;
        }
    	return view('bookings.index', ['bookings' => $booking , 'name' => $name , 'business_id' => $business_id]);
    }

    public function show(){
        //
    }

    public function create( $business_id ){
        
        $employees = Business::find($business_id)
                            ->employees
                            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                            ->pluck('name','id');
        
        $services = Business::find($business_id)
                            ->services
                            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                            ->pluck('name', 'id');
        $working_days = Business::find($business_id)->employees->pluck('working_hours');
        // return $working_days;
        // $bookings = new Booking();
        // $employees= $bookings->getAllEmployees();
        // $services = $bookings->getAllServices();
        return view('bookings.create', ['business_id' => $business_id , 'employees' => $employees , 'services' => $services]);
    } //create() ends

    public function store($business_id){
        
        $slot       = Meta::where(['ref_id' => request('ref_id'), 'ref_name' => 'Employee'])->pluck('value')->first();
        $slot_index = request('slot_index');
        
        $obj  = new Booking(request(['business_id','ref_id']));
        // $obj->ref_name = 'Employee';
        // $obj->booking_details = json_encode(['services' => request()->services]);
        // $obj->save();
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

    	Session::flash('message', 'Successfully Added..!'); 
		Session::flash('alert-class', 'alert-success'); 
    	return redirect()->route('business.bookings.index', $business_id);
    } //store() ends

    public function edit($business_id , $booking_id ){
        $bookings = Booking::find($booking_id);
        $employees= $bookings->getAllEmployees();
        $services = $bookings->getAllServices();
        $ref_name = $bookings->object();
        $name     = $ref_name->name;

        return view('bookings.edit' , ['business_id' => $business_id , 'booking_id' => $booking_id , 'employees' => $employees, 'name' => $name, 'services' => $services]);
    }

    public function update($business_id , $booking_id){
        $obj = Booking::find($booking_id);
        $obj->business_id = request('business_id');
        $obj->id          = $booking_id;
        $obj->ref_id      = request('ref_id');
        $obj->ref_name    = 'Employee';
        $obj->booking_details = json_encode(['services' => request()->services]);
        $obj->update();

    	Session::flash('message', 'Updated..!'); 
		Session::flash('alert-class', 'alert-success'); 
    	return redirect()->route('business.bookings.index', $business_id);
    }

    public function destroy( $business_id , $booking_id ){
        $booking = Booking::find($booking_id);
        $booking->delete();
        Session::flash('message', 'Deleted Successfully..!'); 
		Session::flash('alert-class', 'alert-danger'); 
    	return redirect()->route('business.bookings.index', $business_id);
    }

    
}
