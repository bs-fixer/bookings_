<?php

namespace App;
use App\Service;
use App\Employee;
use App\Booking;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];
    protected $casts = [
        'working_days' => 'array',
        'working_hours'=> 'array'
    ];
 	
 	public function services(){
 		return $this->hasMany(Service::class);
 	}   

 	public function employees(){
 		return $this->hasMany(Employee::class);
	}
	 
	public function bookings(){
		return $this->hasMany(Booking::class);
	}

	public static function getSlotDetail( $ref_id , $ref_name ){
		$metaDetail    = Meta::where(['ref_id' => $ref_id, 'ref_name' => $ref_name ])->get();
        foreach($metaDetail as $key => $val){
            $slot = $val->meta_details;
            $sl = json_decode($slot);
            $sl = $sl->slot;
        }
        return $sl;
	}

}
