<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
