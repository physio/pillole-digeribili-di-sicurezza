<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichardStyles\EloquentEncryption\Casts\Encrypted;

class Plugin extends Model
{
    use HasFactory;

    public $casts = [
        'documentNumber' => 'encrypted',
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
