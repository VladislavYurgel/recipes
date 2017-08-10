<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredients extends \Eloquent
{
    protected $fillable = [
        'recipe_id', 'ingredient_id', 'count_type', 'count'
    ];

    /**
     * Get ingredient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ingredient()
    {
        return $this->hasOne(Ingredients::class, 'id', 'ingredient_id');
    }

    /**
     * Get count type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function countType()
    {
        return $this->hasOne(IngredientCountTypes::class, 'id', 'count_type');
    }
}
