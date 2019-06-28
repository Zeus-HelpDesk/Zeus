<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Markdown;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|User[] $assignees
 * @property-read Collection|Audit[] $audits
 * @property-read Building $building
 * @property-read Collection|Comment[] $comments
 * @property-read District $district
 * @property-read User $user
 * @method static Builder|Ticket whereBuildingId($value)
 * @method static Builder|Ticket whereCategoryId($value)
 * @method static Builder|Ticket whereCompletedAt($value)
 * @method static Builder|Ticket whereCreatedAt($value)
 * @method static Builder|Ticket whereDescription($value)
 * @method static Builder|Ticket whereDistrictId($value)
 * @method static Builder|Ticket whereHash($value)
 * @method static Builder|Ticket whereId($value)
 * @method static Builder|Ticket wherePriorityId($value)
 * @method static Builder|Ticket whereRoom($value)
 * @method static Builder|Ticket whereUpdatedAt($value)
 * @method static Builder|Ticket whereUserId($value)
 * @mixin Eloquent
 * @property int $status_id
 * @property-read mixed $html_description
 * @method static Builder|Ticket newModelQuery()
 * @method static Builder|Ticket newQuery()
 * @method static Builder|Ticket query()
 * @method static Builder|Ticket whereStatusId($value)
 */
class Ticket extends Model implements Auditable
{
    use AuditableTrait;

    protected $fillable = ['description', 'priority_id', 'category_id', 'user_id', 'room', 'district_id', 'building_id'];

    /**
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    /**
     * @return BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * @return BelongsToMany
     */
    public function assignees()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo('App\Models\Priority');
    }

    /**
     * @return string
     */
    public function getHtmlDescriptionAttribute()
    {
        return Markdown::convertToHtml("{$this->description}");
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
                // Based on my calculations this code should provide 1,406,408,600,000 possible combinations, I might be wrong though
                $hash = Hashids::encode(gmp_random_bits(31));
            }
            $status = Status::whereDefault(true)->first(['id']);
            $model->status_id = $status->id;
            $model->hash = $hash;
            $model->completed_at = null;
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
