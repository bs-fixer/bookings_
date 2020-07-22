<?php

namespace App;

use App\Business;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $guarded = [];
	protected $casts   = [
        'services' => 'array',
    ];
    public function business(){
    	return $this->belongsTo(Business::class);
    }
}
