<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Advanced;
use App\Models\Simply;
use App\Models\Plugin;

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
        case 'advanced':
            $result = Advanced::all();
            break;
        case 'plugin':
            $result = Plugin::all();
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
                'Encrypt' => $row->getNumberRaw()
            ];
        }
        $this->table(["ID", "Type", "Decrypt", "Encrypt"], $c );
        return 0;
    }
}
