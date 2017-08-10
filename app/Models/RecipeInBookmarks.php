<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeInBookmarks extends Model
{
    protected $fillable = [
        'user_id', 'recipe_id'
    ];
}
