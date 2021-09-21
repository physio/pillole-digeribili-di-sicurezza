<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Plugin;
use App\Models\Simply;
use App\Models\Advanced;

class GenerateDocument extends CommandBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelday:store {method} {type} {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sambple with Laravel Encryption';

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

    protected function storeAdvanced($data) {
        return Advanced::create($data);
    }

    protected function storePlugin($data) {
        return Plugin::create($data);
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
            case 'advanced':
                $result = $this->storeAdvanced($data);
                break;
            case 'plugin':
                $result = $this->storePlugin($data);
                break;                            
            default:
                $return = false;
                break;
        }

        if ($result) return $this->completeTask();
            else return $this->errorTask($return);
    }
}
