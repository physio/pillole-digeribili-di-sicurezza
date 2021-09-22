<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Simply extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentType',
        'documentNumber'
    ];

    /**
     * Set the documentNumber.
     *
     * @param  string  $value
     * @return void
     */
    public function setDocumentNumberAttribute($value)
    {
        $this->attributes['documentNumber'] = Crypt::encryptString($value);
    }


    /**
     * Get the documentNumber decrypted.
     *
     * @param  string  $value
     * @return string
     */
    public function getDocumentNumberAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Decrypt error.';
        }
    }


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
