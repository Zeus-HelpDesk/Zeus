<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Priority
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Priority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Priority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Priority whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Priority whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Priority extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}