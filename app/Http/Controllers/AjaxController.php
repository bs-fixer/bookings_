<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Meta;
use App\Helper;
use App\Booking;

class AjaxController extends Controller
{
    public function getWorkingDays(){
        $emp_id      = request('emp_id');
        $business_id = request('business_id');
        // return 'Employee Id => '.$emp_id;
        $days        = Employee::where([ 'id' => $emp_id , 'business_id' => $business_id ])->pluck('working_days')->first();
        // return $days; //associative array

        // $days_list   = ['monday', 'tuesday', 'wednesday','thursday', 'friday', 'saturday','sunday'];
        $days_list   = ['sunday','monday', 'tuesday', 'wednesday','thursday', 'friday', 'saturday'];
        // return $days_list; //numeric array 
        $keyKeeper      = [];
        foreach($days as $day){
            if( in_array( $day, $days_list ) ){
                // $keyKeeper[] = array_search($day, $days_list)+1;
                $keyKeeper[] = array_search($day, $days_list);
            }
        }
        // return $keyKeeper;

        $keyKeeper1      = [];
        foreach($days_list as $key => $dl){
            // $keyKeeper1[] = $key+1;
            $keyKeeper1[] = $key;
        }
        // return $keyKeeper1;
        $disableDays = array_diff($keyKeeper1,$keyKeeper);
        return array_values($disableDays);
    } //getWorkingDays() end

    public function getSlotsHtml(){
        $date = request('date');
        $nameOfDay= strtolower(date('l', strtotime($date)) );
        $business_id = request('business_id');
        $ref_id   = request('ref_id');
        $ref_name = request('ref_name');
        $slotTime = Meta::where( ['ref_id' => $ref_id , 'ref_name' => $ref_name] )->pluck('value')->first();
        $dayMinute= 1440;
        //count total slots in a day
        $totalSlot=1440/$slotTime;
        //get employee working hours
        $workingHours = Employee::where(['id' => $ref_id ])->pluck('working_hours')->first();
        // $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        
        // $fromSeconds = [];
        // foreach($days as $day){
            // if(isset($workingHours[$nameOfDay])){
            //     foreach($workingHours[$nameOfDay]['from'] as $key => $from ){
            //         if(isset($from)){
            //             $fromList       = explode(':', $from);
            //             $fromSeconds[]  = (($fromList[0] * 3600) + ($fromList[1] * 60));
            //         }
            //     }
            // }
        // }

        $slots  = Booking::where([
                    'business_id' => $business_id, 
                    'ref_id'      => $ref_id, 
                    'ref_name'    => $ref_name, 
                    'date'        => $date
                ])->get('slot');
        $slotindex = [];
        foreach($slots as $slot){
            $slotindex[] = $slot->slot;
        }

        $div = '';
        for($i=1; $i<=$totalSlot; $i++){
            $available = false;
            $booked    = false;
            $to        = $i*$slotTime*60;
            $fromval   = $to-($slotTime*60);
            $div.='<div class="col-md-2 slot" style="margin-bottom:5px;">';
            // $slotindex = (int) Booking::where([
            //                                 'business_id' => $business_id, 
            //                                 'ref_id'      => $ref_id, 
            //                                 'ref_name'    => $ref_name, 
            //                                 'date'        => $date
            //                             ])->pluck('slot')->first();

            
            // if( isset($slotindex) ){
            //     $toSlot     = $slotTime*$slotindex*60;
            //     $fromSlot   = $slotTime*($slotindex-1)*60;
            // }

            // if( $i == $slotindex ){
            //     $booked = true;
            // }
            
            if( in_array($i,$slotindex) ){
                $booked = true;
            }
            else{
                
                if(isset($workingHours[$nameOfDay])){
                    foreach($workingHours[$nameOfDay]['from'] as $key => $from ){
                        if(isset($from)){
                            $fromList      = explode(':', $from);
                            $fromSeconds   = (($fromList[0] * 3600) + ($fromList[1] * 60));
                            $getTo         = $workingHours[$nameOfDay]['to'][$key];
                            $toList        = explode(':', $getTo);
                            $toSeconds     = (($toList[0] * 3600) + ($toList[1] * 60));
                            if($fromval >= $fromSeconds && $to <= $toSeconds){
                                $available = true;
                            }
                        }//isset(form) ends
                    }//foreach ends
                }//workingdays isset 
            } //else ends

            if( $available == true && $booked == false){
                // $div.='<a href="#" class="btn btn-block btn-success slot_time" name="slot_index" data-from="'.$fromval.'" data-to="'.$to.'">From '.gmdate('H:i', $fromval).' To '.(gmdate('H:i',$to) ).'</a>';
                $div.="From ".gmdate('H:i', $fromval)." To ".(gmdate('H:i',$to) );
                $div.='<input type="radio" name="slot_index" value="'.$i.'" class="slot_index" data-from="'.$fromval.'" data-to="'.$to.'">';
            }
            else{
                $div.='<a href="#" class="btn btn-block btn-danger slot_time" data-from="'.$fromval.'" name="slot_index" data-to="'.$to.'">From '.gmdate('H:i', $fromval).' To '.(gmdate('H:i',$to) ).'</a>';            
            }
            $div.='</div>';
        } //for ends
        return $div;
        
        /* WORKING FROM HERE */
        // $fromSeconds = [];
        // foreach($days as $day){
        //     if(isset($workingHours[$day])){
        //         foreach($workingHours[$day]['from'] as $key => $from ){
        //             if(isset($from)){
        //                 $fromList       = explode(':', $from);
        //                 $fromSeconds[]  = (($fromList[0] * 3600) + ($fromList[1] * 60));
        //             }
        //         }
        //     }
        // }
        // $div = '';
        // for($i=1; $i<=$totalSlot; $i++){
        //     $to   = $i*$slotTime*60;
        //     $from = $to-($slotTime*60);
        //     $div.='<div class="col-md-2 slot" style="margin-bottom:5px;">';
        //         if(!in_array($from,$fromSeconds)){
        //             $div.='<a href="#" class="btn btn-block btn-danger slot_time" data-from="'.$from.'" data-to="'.$to.'">From '.gmdate('H:i', $from).' To '.(gmdate('H:i',$to) ).'</a>';
        //         }
        //         else{
        //             $div.='<a href="#" class="btn btn-block btn-success slot_time" data-from="'.$from.'" data-to="'.$to.'">From '.gmdate('H:i', $from).' To '.(gmdate('H:i',$to) ).'</a>';
        //         }
        //         $div.='</div>';
        // }
        // return $div;
        
    } //getSlotsHtml() ends
}
