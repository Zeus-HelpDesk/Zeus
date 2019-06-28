<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|\App\Category whereCreatedAt($value)
 * @method static Builder|\App\Category whereId($value)
 * @method static Builder|\App\Category whereName($value)
 * @method static Builder|\App\Category whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $description
 * @property string $icon
 * @method static Builder|\App\Category whereDescription($value)
 * @method static Builder|\App\Category whereIcon($value)
 * @method static Builder|\App\Category newModelQuery()
 * @method static Builder|\App\Category newQuery()
 * @method static Builder|\App\Category query()
 */
class Category extends Model
{
    //
}
