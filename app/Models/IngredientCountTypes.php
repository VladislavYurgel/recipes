<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientCountTypes extends Model
{
    protected $fillable = [
        'name', 'fix_weight_in_gr'
    ];
}
