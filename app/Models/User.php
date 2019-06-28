<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;
use OwenIt\Auditing\Models\Audit;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $password
 * @property string $room
 * @property string|null $phone_number
 * @property int|null $phone_extension
 * @property int $district_id
 * @property int $building_id
 * @property int $staff
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Ticket[] $assigned
 * @property-read Collection|Audit[] $audits
 * @property-read \App\Building $building
 * @property-read Collection|\App\Comment[] $comments
 * @property-read \App\District $district
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Collection|\App\Ticket[] $tickets
 * @method static Builder|\App\User whereBuildingId($value)
 * @method static Builder|\App\User whereCreatedAt($value)
 * @method static Builder|\App\User whereDistrictId($value)
 * @method static Builder|\App\User whereEmail($value)
 * @method static Builder|\App\User whereId($value)
 * @method static Builder|\App\User whereName($value)
 * @method static Builder|\App\User wherePassword($value)
 * @method static Builder|\App\User wherePhoneExtension($value)
 * @method static Builder|\App\User wherePhoneNumber($value)
 * @method static Builder|\App\User whereRememberToken($value)
 * @method static Builder|\App\User whereRoom($value)
 * @method static Builder|\App\User whereSlug($value)
 * @method static Builder|\App\User whereStaff($value)
 * @method static Builder|\App\User whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $api_limit
 * @property string|null $email_verified_at
 * @property-read Collection|Client[] $clients
 * @property-read Collection|Token[] $tokens
 * @method static Builder|\App\User whereApiLimit($value)
 * @method static Builder|\App\User whereEmailVerifiedAt($value)
 * @method static Builder|\App\User newModelQuery()
 * @method static Builder|\App\User newQuery()
 * @method static Builder|\App\User query()
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, ThrottlesLogins, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'district_id', 'building_id', 'room', 'phone_number', 'phone_extension', 'staff'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * District the user is assigned to
     *
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    /**
     * Building the user is assigned to
     *
     * @return BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }

    /**
     * Tickets user has submitted
     *
     * @return HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    /**
     * Comments a user has made
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Tickets a user is assigned to
     *
     * @return BelongsToMany
     */
    public function assigned()
    {
        return $this->belongsToMany('App\Models\Ticket')->withTimestamps();
    }

    /**
     * Boot method
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Check if a user with the name is already in the database
            if (!empty(User::whereName($model->name)->latest()->get()->first())) {
                $current_user = User::whereName($model->name)->latest()->get()->first();
                $old_slug = explode('.', $current_user['slug']);
                // Handle the new slug ending, if integer add 1 to the last user value otherwise just put a 1 at the end
                $slug_end = is_numeric(end($old_slug)) ? end($old_slug) + 1 : 1;
                $slug = Str::slug($model->name . ' ' . $slug_end, '.');
            } else {
                $slug = Str::slug($model->name, '.');
            }
            $model->slug = $slug;
        });
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
