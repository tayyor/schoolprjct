<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name', 'family_size', 'income_range', 'unit_id', 'occupation', 'age_range','contact'
    ];

    public function unit(){
        return $this->hasOne('App\Unit', 'id', 'unit_id');
    }
}
