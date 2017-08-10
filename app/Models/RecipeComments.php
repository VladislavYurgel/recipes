<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeComments extends Model
{
    protected $fillable = [
        'user_id', 'recipe_id', 'text', 'rating'
    ];

    /**
     * Get comment images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(RecipeCommentImages::class, 'comment_id');
    }

    /**
     * Get user from comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
