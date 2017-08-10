<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeInTags extends Model
{
    protected $fillable = [
        'recipe_id', 'tag_id'
    ];
}
