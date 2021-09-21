<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;

class Advanced extends Model
{
    use HasFactory;

    protected $appEncryptionKey = config('app.encryption_key');
    protected $encrypter = new Encrypter($appEncryptionKey);

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
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setDocumentNumberAttribute($value)
    {
        $this->attributes['documentNumber'] = $this->encrypter($encrypter);
    }


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
