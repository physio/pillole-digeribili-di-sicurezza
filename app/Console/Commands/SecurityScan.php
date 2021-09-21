<?php

namespace App\Console\Commands;

use Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use Enlightn\SecurityChecker\SecurityChecker;

class SecurityScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vulnerabilities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check composer packages vulnerabilities';


    public function handle(): int
    {
        $checker = new SecurityChecker;

        $result = $checker->check(base_path('composer.lock'));

        if (!count($result)) {
            $this->info('No vulnerabilities found');

            return 0;
        }

        $this->table(['Package', 'Time', 'Description'], $this->format($result));

        $this->notification($result);

        return 0;
    }

    private function format(array $result): array
    {
        return (collect($result)->map(function ($item, $key) {
            return [
                'package' => "{$key}@{$item['version']}",
                'time' => Carbon::parse($item['time'])->format('Y:m:d'),
                'advisories' => collect($item['advisories'])->map(function($item) {
                    return $item['link'];
                })->first(),
            ];
        }))
        ->toArray();
    }

    private function notification(array $result): void
    {
        // $user = User::where('email', env('SECURITY_NOTIFICATION_EMAIL'));

        // Mail::to($user)->send(new SecutityNotification($result));
    }
}
