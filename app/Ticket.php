<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Ticket
 *
 * @property int $id
 * @property string $hash
 * @property string $description
 * @property int $district_id
 * @property int $building_id
 * @property string $room
 * @property int $user_id
 * @property int $priority_id
 * @property int $category_id
 * @property string $completed_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $assignees
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read \App\Building $building
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\District $district
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereUserId($value)
 * @mixin \Eloquent
 */
class Ticket extends Model implements Auditable
{
    use AuditableTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\District');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('App\Building');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assignees()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * The boot method
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $hash = null;
            while (Ticket::whereHash($hash)->get()->count() > 0 || $hash === null) {
                $hash = \Hashids::encode(gmp_random_bits(31));
            }
            $model->hash = $hash;
        });
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'hash';
    }

}
