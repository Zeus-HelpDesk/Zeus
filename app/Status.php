<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Status
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @mixin \Eloquent
 */
class Status extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
