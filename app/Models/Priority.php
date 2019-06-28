<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Priority
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Ticket[] $tickets
 * @method static Builder|\App\Priority whereCreatedAt($value)
 * @method static Builder|\App\Priority whereId($value)
 * @method static Builder|\App\Priority whereName($value)
 * @method static Builder|\App\Priority whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $description
 * @method static Builder|\App\Priority whereDescription($value)
 * @method static Builder|\App\Priority newModelQuery()
 * @method static Builder|\App\Priority newQuery()
 * @method static Builder|\App\Priority query()
 */
class Priority extends Model
{
    protected $fillable = ['name', 'description'];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }
}
