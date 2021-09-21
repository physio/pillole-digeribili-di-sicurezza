<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichardStyles\EloquentAES\Casts\AESEncrypted;

class Aes extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'documentNumber' => AESEncrypted::class,
    ];

    protected $fillable = [
        'documentType',
        'documentNumber'
    ];


    /**
     * Get the documentNumber encrypted.
     *
     * @param  string  $value
     * @return string
     */
    public function getRaw()
    {
        return substr($this->attributes['documentNumber'],0,50);
    }     
}
