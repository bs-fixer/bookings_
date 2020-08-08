<?php

namespace App;
use App\Service;
use App\Employee;
use App\Business; 
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = []; 
    protected $casts = [
        'services' => 'array',
        'employee'=> 'array'
    ];

    public function business(){
        return $this->hasMany(Business::class);
    }

    public function object(){
        $id    = $this->ref_id;
        $model = 'App\\'.$this->ref_name;
        return $model::find($id);
    }

    public function getAllEmployees(){
        $id = $this->business_id;
        return  Business::find($id)
                        ->employees
                        ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                        ->pluck('name','id');
    }

    public function getAllServices(){
        $id = $this->business_id;
        return  Business::find($id)
                        ->services
                        ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                        ->pluck('name', 'id');
    }

}
