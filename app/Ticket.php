<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function assignees()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
