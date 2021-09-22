<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rsa;
use App\Models\Simply;
use App\Models\Aes;

class GenerateDocument extends CommandBase
{
    private $providers = [
        'simply' => Simply::class,
        'rsa' => Rsa::class,
        'aes' => Aes::class
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelday:store
                        {method : metodo di salvataggio. Le opzioni disponibili sono simply, rsa e aes }
                        {type : tipologia di documento da salvare }
                        {number : dato sensibile da salvare criptato }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sample with Laravel Encryption';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');
        $number = $this->argument('number');
        $method = $this->argument('method');

        $this->startTask("Create sensible data {$type}");

        $provider = $this->providers[$method];

        if (!$provider) {
            return $this->errorTask('Invalid method selected');
        }

        $result = $provider::create([
            'documentType' => $type,
            'documentNumber' => $number,
        ]);

        if ($result) {
            return $this->completeTask();
        }

        return $this->errorTask();
    }
}
