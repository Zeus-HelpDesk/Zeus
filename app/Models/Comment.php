<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Markdown;

/**
 * App\Comment
 *
 * @property int $id
 * @property string $comment
 * @property int $ticket_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Ticket $ticket
 * @property-read User $user
 * @method static Builder|Comment whereComment($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereTicketId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @mixin Eloquent
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 */
class Comment extends Model
{

    protected $fillable = ['comment', 'ticket_id', 'user_id'];

    /**
     * Return HTML for comment
     *
     * @return string
     */
    public function getHtmlCommentAttribute()
    {
        return Markdown::convertToHtml("{$this->comment}");
    }

    /**
     * @return BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
