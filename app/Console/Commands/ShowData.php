<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Simply;
use App\Models\Rsa;
use App\Models\Aes;

class ShowData extends CommandBase
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
    protected $signature = 'laravelday:show {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show data encrypted and decrypted saved into DB';

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
        $method = $this->argument('type');
        $error = false;

        if (!array_key_exists($method, $this->providers)) {
            $error = true;
            return $this->errorTask('Invalid method selected');
        }

        $provider = resolve($this->providers[$method]);

        $result = $provider::all();

        $table = array();
        foreach ($result as $row) {
            $table[] = [
                'ID' => $row-> id,
                'Type' => $row->documentType,
                'Decrypt' => $row->documentNumber,
                'Encrypt' => $row->getRaw()
            ];
        }
        $this->table(["ID", "Type", "Decrypt", "Encrypt"], $table );

        if (!$error) {
            return $this->completeTask();
        }

        return $this->errorTask();
    }
}
