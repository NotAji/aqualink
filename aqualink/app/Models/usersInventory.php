<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usersInventory extends Model
{
    //
    protected $table = "users_inventory";
    protected $fillable = [
        'name',
        'price',
        'quantity'
    ];
}
