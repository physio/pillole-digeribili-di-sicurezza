<p align="center"><a href="https://2021.laravelday.it/" target="_blank"><img src="./design/laravel-2021.png" width="400"></a></p>

# Laravel@127.0.0.1 2021

24 settembre 2021 @ localhost

laravelday è la conferenza italiana dedicata a uno dei framework più utilizzati per PHP, uno strumento molto potente, che ha portato molta innovazione nell'ambiente.
Organizzata ogni anno a partire dal 2017, laravelday vuole dare una panoramica su questa tecnologia e su tutto il suo ecosistema, e permettere alla community di developer laravel di incontrarsi e condividere esperienze e buone pratiche.

L'edizione 2021 di laravelday si svolge il 24 Settembre, online, nel formato '@localhost'.

## Pillole digeribili di Sicurezza

Buone pratiche, package, idee e suggerimenti per mettere in sicurezza il proprio applicativo a livello strutturale e cercare di dormire più tranquilli.

Simuliamo una pagina web in cui l'utente deve registrare un documento di riconoscimento. Poniamo l'esempio quindi in cui l'utente deve salvare un dato in chiaro (ad esempio il tipo di documento, scusate la poca fantasia) e il numero di documento (questo invece sarà un dato protetto).

Le informazioni riguardanti i modelli e il DB si trovano alla [pagina dedicata](design/database.md).


### Librerie Utilizzate

- [RichardStyles/EloquentEncryption](https://github.com/RichardStyles/EloquentEncryption): utilizzato per consentire un ulteriore livello di sicurezza durante la gestione dei dati sensibili. Consente ai campi chiave dei tuoi modelli di essere crittografati.
- [graham-campbell/throttle](https://github.com/GrahamCampbell/Laravel-Throttle): Utilizzato per evitare di sovraccaricare le richieste. Utilizzato soprattuto nella API.
- [laravel-surveillance](https://github.com/neelkanthk/laravel-surveillance): Utilizzato per mettere sotto sorveglianza utenti malintenzionati, indirizzi IP e impronte digitali del browser anonime, scrivere registri di sorveglianza e impedire a quelli malintenzionati di accedere all'app.


### Utilizzo dei comandi da CLI
Riporto il testo dalla documentazione di Laravel Surveillance.

#### Enable surveillance for an IP Address
```bash
php artisan surveillance:enable ip 192.1.2.4
```

#### Disable surveillance for an IP Address
```bash
php artisan surveillance:disable ip 192.1.2.4
```

#### Enable surveillance for a User ID
```bash
php artisan surveillance:enable userid 1234
```

#### Disable surveillance for a User ID
```bash
php artisan surveillance:disable userid 1234
```

#### Enable surveillance for Browser Fingerprint
```bash
php artisan surveillance:enable fingerprint hjP0tLyIUy7SXaSY6gyb
```

#### Disable surveillance for Browser Fingerprint
```bash
php artisan surveillance:disable fingerprint hjP0tLyIUy7SXaSY6gyb
```

#### Block an IP Address
```bash
php artisan surveillance:block ip 192.1.2.4
```

#### UnBlock an IP Address
```bash
php artisan surveillance:unblock ip 192.1.2.4
```

#### Block a User ID
```bash
php artisan surveillance:block userid 1234
```

#### UnBlock a User ID
```bash
php artisan surveillance:unblock userid 1234
```

#### Block a Browser Fingerprint
```bash
php artisan surveillance:block fingerprint hjP0tLyIUy7SXaSY6gyb
```

#### UnBlock a Browser Fingerprint
```bash
php artisan surveillance:unblock fingerprint hjP0tLyIUy7SXaSY6gyb
```

#### Remove a Surveillance record from Database
```bash
php artisan surveillance:remove ip 192.5.4.3
```

### Utilizzo di Laravel Sureillance nel Middleware

You can use the 'surveillance' middleware on any route or route group just like any other middleware.

_NOTE: The middleware looks for the browser fingerprint in the header name as set in the `fingerprint-header-key` inside `config/surveillance.php`_

```php
Route::middleware(["surveillance"])->get('/', function () {
    
});
```


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
