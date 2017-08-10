<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCommentImages extends Model
{
    protected $fillable = [
        'comment_id', 'image_index', 'path'
    ];
}
