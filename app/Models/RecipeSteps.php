<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeSteps extends \Eloquent
{
    protected $fillable = [
        'step_index', 'text'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Get recipe step images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(RecipeStepImages::class, 'step_id')->orderBy('image_index');
    }
}
