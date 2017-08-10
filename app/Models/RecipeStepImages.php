<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeStepImages extends \Eloquent
{
    protected $fillable = [
        'step_id', 'image_index', 'path'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
