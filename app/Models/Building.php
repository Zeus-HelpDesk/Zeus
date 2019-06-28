<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\District $district
 * @property-read Collection|\App\Ticket[] $tickets
 * @property-read Collection|\App\User[] $users
 * @method static Builder|\App\Building whereAddress($value)
 * @method static Builder|\App\Building whereCode($value)
 * @method static Builder|\App\Building whereCreatedAt($value)
 * @method static Builder|\App\Building whereDistrictId($value)
 * @method static Builder|\App\Building whereId($value)
 * @method static Builder|\App\Building whereName($value)
 * @method static Builder|\App\Building wherePhoneExtension($value)
 * @method static Builder|\App\Building wherePhoneNumber($value)
 * @method static Builder|\App\Building whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|\App\Building newModelQuery()
 * @method static Builder|\App\Building newQuery()
 * @method static Builder|\App\Building query()
 */
class Building extends Model
{
    protected $fillable = ['name', 'address', 'phone_number', 'phone_extension', 'code', 'district_id'];

    /**
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District');
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
