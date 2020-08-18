<?php

namespace App\Http\Controllers;
use App\Employee;
use App\Business;
use Illuminate\Http\Request;
use Session;
use App\Meta;

class EmployeeController extends Controller
{
    public function index($business_id){
        $business = Business::find($business_id);
        $business->employees;
    	return view('employee.index', ['employees' => $business['employees'] ,'business_id' => $business_id ]);
    }

    public function create($business_id){
        
        $services = Business::find($business_id)
                            ->services
                            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                            ->pluck('name', 'id');

        $days      = ['default','monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $time_slot = ['15' => 15, '30' => 30, '45' => 45, '60' => 60 ];
        return view('employee.create', [
                                        'days'        => $days , 
                                        'services'    => $services , 
                                        'business_id' => $business_id, 
                                        'time_slot'   => $time_slot
                                    ]);
    }

    public function store(Request $request){

    	$obj = new Employee(request(['business_id','name', 'working_days' , 'working_hours']));
    	$obj->save();
        $obj->services()->attach( request()->services );

         /* To save meta record */
         $metaObj = new Meta();
         $metaObj->ref_id = $obj->id;
         $metaObj->ref_name = 'Employee';
        //  $metaObj->meta_details = json_encode(['slot' => request('slot')]);
        $metaObj->key = 'slot';
        $metaObj->value = request('slot');
         $metaObj->save();
         /* end to save meta record */

    	Session::flash('message', 'Successfully Added..!'); 
        Session::flash('alert-class', 'alert-success'); 
    	return redirect()->route('employee.index',['business_id' => request('business_id')]);
    }

    
    public function edit($business_id , $employee_id ){
        
        $employee      = Employee::find($employee_id);
        $services      = $employee->services->pluck('id')->toArray();
        $days          = ['default', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $working_hours = $employee['working_hours'];
        $time_slot     = ['15' => 15, '30' => 30, '45' => 45, '60' => 60 ];
        $business_services = Business::find($business_id); 
        $services_list = $business_services->services
                      ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                      ->pluck('name', 'id');
        // $keeper = [];
        // foreach($working_hours as $day => $hours ){
        //     foreach($working_hours[$day]['to'] as $i => $to){
        //         $keeper[$day][$i]['to']    = $to;
        //         $keeper[$day][$i]['from']  = $working_hours[$day]['from'][$i];
        //     }    
        // }
        
        /* to get slot value */
        $slot = Business::getSlotDetail($employee_id , 'Employee' );
        /* end to get slot value */
        return view('employee.edit' , [
                                        'employee_id' => $employee_id , 
                                        'business_id' => $business_id , 
                                        'employee'    => $employee , 
                                        'services'    => $services , 
                                        'days'        => $days , 
                                        'working_hours'=> $working_hours , 
                                        'services_list'=> $services_list,
                                        'slot'        => $slot,
                                        'time_slot'   => $time_slot
                                    ]);
    } //edit ends
            
    public function update($business_id , $employee_id ){
        $emp = Employee::find($employee_id);
        $emp->update(request(['business_id' , 'name' , 'working_days', 'working_hours']));
        $emp->services()->sync(request('services',[]));
        /* to update slot */
        $metaObj = Meta::where(['ref_id'=>$employee_id, 'ref_name' => 'Employee'])->first();
        // $metaObj->meta_details = json_encode(['slot' => request('slot')]);
        $metaObj->key   = 'slot';
        $metaObj->value = request('slot');
        $metaObj->update();
        /* end to update slot */
        
        Session::flash('message', 'Successfully Updated..!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->route('employee.index',['business_id' => request('business_id')]);
    } //update() ends
            
    public function destroy($business_id , $employee_id ){
        $employee = Employee::find($employee_id);
        $business = $employee->business['id'];
        if($business == $business_id ){
            $employee->delete();
            return redirect()->route('employee.index' , ['business_id' => $business_id ]);
        }
    } //destroy() ends
}

