<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Building
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string|null $phone_number
 * @property string|null $phone_extension
 * @property int $district_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\District $district
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building wherePhoneExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Building whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Building extends Model
{
    protected $fillable = ['name', 'address', 'phone_number', 'phone_extension', 'code', 'district_id'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\District');
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
