<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fish extends Model
{
    //
    protected $fillable = ['users_id', 'name', 'price', 'quantity'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->hasmany(Booking::class);
    }
}
