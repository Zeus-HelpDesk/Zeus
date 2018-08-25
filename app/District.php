<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\District
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string|null $phone_number
 * @property string|null $phone_extension
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Building[] $buildings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District wherePhoneExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class District extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings()
    {
        return $this->hasMany('App\Building');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // If an invite code is not set this will set one
            if (empty($model->code)) {
                $code = null;
                while (Ticket::whereHash($code)->get()->count() > 0 || $code === null) {
                    // Based on my calculations this code should provide 1,406,408,600,000 possible combinations, I might be wrong though
                    $code = \Hashids::connection('invite')->encode(gmp_random_bits(11));
                }
                $model->code = $code;
            }
        });
    }
}
