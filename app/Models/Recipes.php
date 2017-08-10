<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipes extends \Eloquent
{
    protected $fillable = [
        'title', 'short_desc', 'desc', 'time', 'level'
    ];

    /**
     * Get all recipes steps
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(RecipeSteps::class, 'recipe_id')
            ->orderBy('step_index');
    }

    /**
     * Get all recipe images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(RecipeImages::class,'recipe_id')->orderBy('image_index');
    }

    /**
     * Get all recipe comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(RecipeComments::class, 'recipe_id');
    }

    /**
     * Get all ingredients for recipe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingredients()
    {
        return $this->hasMany(RecipeIngredients::class, 'recipe_id');
    }

    /**
     * Get recipe rating
     *
     * @return float|int
     */
    public function getRating()
    {
        $rating = $commentsCount = 0;
        $this->comments()->each(function($a) use (&$rating, &$commentsCount){
            $rating += $a->rating;
            $commentsCount++;
        });
        return $rating / $commentsCount;
    }
}
