<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function getNumberRaw()
    {
        return $this->documentNumber;
    }
}
