<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Status
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $closes_ticket
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereClosesTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereUpdatedAt($value)
 */
class Status extends Model
{
    protected $table = 'status';

    protected $fillable = ['name', 'description', 'closes_ticket'];

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
