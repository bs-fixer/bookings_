<?php

namespace App;
use App\Service;
use App\Employee;
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
 
}
