<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class reports extends Model
{
    //
    protected $fillable = ['users_id', 'fish_id', 'sellerName', 'fishName'];

    public function fish()
    {
        return $this->belongsTo(fish::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
