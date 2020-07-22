<?php

namespace App;
use App\Service;
use App\Business;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];
    protected $casts = [
        'working_days' => 'array',
        'working_hours'=> 'array'
    ];
    public function services(){
    	return $this->belongsToMany(Service::class);
    }

    public function business(){
    	return $this->belongsTo(Business::class);
    }
}
