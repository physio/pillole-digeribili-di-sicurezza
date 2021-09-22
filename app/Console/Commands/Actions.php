<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Action;

class Actions extends CommandBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelday:actions';

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
        $result = Action::all();
        $this->table(["user_id", "fingerprint", "action", "data", "created_at", "edit_at"], $result );
        return 0;
    }
}