<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emoji extends Model
{
    use SoftDeletes;

    protected $table = 'emoji';

    protected $fillable = [
        'name',
        'image_url'
    ];
}
