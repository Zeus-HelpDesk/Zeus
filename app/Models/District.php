<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\District
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string|null $phone_number
 * @property string|null $phone_extension
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Building[] $buildings
 * @property-read Collection|\App\Ticket[] $tickets
 * @property-read Collection|\App\User[] $users
 * @method static Builder|\App\District whereAddress($value)
 * @method static Builder|\App\District whereCode($value)
 * @method static Builder|\App\District whereCreatedAt($value)
 * @method static Builder|\App\District whereId($value)
 * @method static Builder|\App\District whereName($value)
 * @method static Builder|\App\District wherePhoneExtension($value)
 * @method static Builder|\App\District wherePhoneNumber($value)
 * @method static Builder|\App\District whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|\App\District newModelQuery()
 * @method static Builder|\App\District newQuery()
 * @method static Builder|\App\District query()
 */
class District extends Model
{

    protected $fillable = ['name', 'address', 'phone_number', 'phone_extension', 'code'];

    /**
     * @return HasMany
     */
    public function buildings()
    {
        return $this->hasMany('App\Models\Building');
    }

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * @return HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
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
                    $code = Hashids::connection('invite')->encode(gmp_random_bits(11));
                }
                $model->code = $code;
            }
        });
    }
}
