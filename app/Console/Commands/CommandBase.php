<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Eloquentencryption;

class CommandBase extends Command
{
    protected $name = "merge-table";
    private $taskName;


    public function startTask(string $name, string $loading = 'running...'): void
    {
        $this->taskName = $name;

        $this->output->write("$name: <comment>{$loading}</comment>");
    }


    public function completeTask(): int
    {
        $this->endTask(true);

        return 0;
    }

    public function errorTask(string $error = 'failed'): int
    {
        $this->endTask(false, $error);

        return 1;
    }

    public function endTask(bool $completed, string $error = 'failed'): void
    {
        $message = "{$this->taskName}: <info>✔</info>";

        if (!$completed) {
            $message = "{$this->taskName}: <error>{$error}</error>";
        }

        if ($this->output->isDecorated()) {
            $this->output->write("\x0D");
            $this->output->write("\x1B[2K");
            $this->output->writeln($message);

            return;
        }

        $this->output->writeln('');
        $this->output->writeln($message);
    }
}
