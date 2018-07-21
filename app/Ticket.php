<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

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
}
