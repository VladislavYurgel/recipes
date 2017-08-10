<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeImages extends \Eloquent
{
    protected $fillable = [
        'recipe_id', 'image_index', 'path'
    ];

    /**
     * Get recipe by recipe image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipe()
    {
        return $this->hasOne(Recipes::class, 'id', 'recipe_id');
    }
}
