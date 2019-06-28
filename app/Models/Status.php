<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Status
 *
 * @property-read Collection|\App\Ticket[] $tickets
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $closes_ticket
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|\App\Status whereClosesTicket($value)
 * @method static Builder|\App\Status whereCreatedAt($value)
 * @method static Builder|\App\Status whereDescription($value)
 * @method static Builder|\App\Status whereId($value)
 * @method static Builder|\App\Status whereName($value)
 * @method static Builder|\App\Status whereUpdatedAt($value)
 * @property int $default
 * @method static Builder|\App\Status newModelQuery()
 * @method static Builder|\App\Status newQuery()
 * @method static Builder|\App\Status query()
 * @method static Builder|\App\Status whereDefault($value)
 */
class Status extends Model
{
    protected $table = 'status';

    protected $fillable = ['name', 'description', 'closes_ticket'];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }
}
