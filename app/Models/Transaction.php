<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the name record associated with the user_id.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
