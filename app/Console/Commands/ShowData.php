<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Simply;
use App\Models\Plugin;
use App\Models\AesPlugin;

class ShowData extends CommandBase
{
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
    protected $description = 'Command description';

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

        switch ($type) {
        case 'simply':
            $result = Simply::all();
            break;
        case 'plugin':
            $result = Plugin::all();
            break;
        case 'aes':
            $result = AesPlugin::all();
            break;
        default:
            return [];
        }
        $c = array();
        foreach ($result as $row) {
            $c[] = [
                'ID' => $row-> id,
                'Type' => $row->documentType,
                'Decrypt' => $row->documentNumber,
                'Encrypt' => $row->getRaw()
            ];
        }
        $this->table(["ID", "Type", "Decrypt", "Encrypt"], $c );
        return 0;
    }
}
