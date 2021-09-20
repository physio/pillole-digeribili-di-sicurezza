<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'fingerprint', 'action', 'data'
    ];


    /**
     * Get the user for the action.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
