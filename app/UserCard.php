<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model {

    protected $table = "user_cards";
    protected $fillable = [
        'user_id', 'brand', 'last_four', 'exp_month', 'exp_year', 'default_type','status'
    ];
    
}