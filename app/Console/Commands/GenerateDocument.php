<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rsa;
use App\Models\Simply;
use App\Models\Aes;

class GenerateDocument extends CommandBase
{
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

    protected function storeSimply($data) {
        return Simply::create($data);
    }

    protected function storeRsa($data) {
        return Rsa::create($data);
    }

    protected function storeAes($data) {
        return Aes::create($data);
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

        $data = [
            'documentType' => $type,
            'documentNumber' => $number,
        ];

        switch ($method) {
            case 'simply':
                $result = $this->storeSimply($data);
                break;
            case 'rsa':
                $result = $this->storeRsa($data);
                break;    
            case 'aes':
                $result = $this->storeAes($data);
                break;                          
            default:
                $return = false;
                break;
        }

        if ($result) return $this->completeTask();
            else return $this->errorTask($return);
    }
}
