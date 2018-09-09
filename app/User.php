<?php

namespace App;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

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
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $assigned
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read \App\Building $building
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\District $district
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, ThrottlesLogins, HasApiTokens, MustVerifyEmail;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\District');
    }

    /**
     * Building the user is assigned to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('App\Building');
    }

    /**
     * Tickets user has submitted
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * Comments a user has made
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Tickets a user is assigned to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assigned()
    {
        return $this->belongsToMany('App\Ticket')->withTimestamps();
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
                $slug = str_slug($model->name . ' ' . $slug_end, '.');
            } else {
                $slug = str_slug($model->name, '.');
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
