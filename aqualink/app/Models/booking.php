<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    protected $table = 'booking';
    protected $fillable = ['users_id', 'fish_id', 'quantity', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function fish()
    {
        return $this->belongsTo(Fish::class);
    }
}
