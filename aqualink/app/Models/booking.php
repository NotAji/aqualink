<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    protected $table = 'booking';
    protected $fillable = ['users_id', 'fish_id', 'fish_name', 'seller_name', 'quantity', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function fish()
    {
        return $this->belongsTo(Fish::class, 'fish_id');
    }
}
