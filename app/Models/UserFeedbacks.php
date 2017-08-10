<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFeedbacks extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'text'
    ];
}
