<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckDependencies extends Command
{
    protected $signature = 'check:dependencies';

    protected $description = 'Check if Node.js and npm are available in the environment';

    public function handle()
    {
        $nodeVersion = shell_exec('node -v');
        $npmVersion = shell_exec('npm -v');

        if ($nodeVersion) {
            $this->info('Node.js version: ' . $nodeVersion);
        } else {
            $this->error('Node.js is not available');
        }

        if ($npmVersion) {
            $this->info('npm version: ' . $npmVersion);
        } else {
            $this->error('npm is not available');
        }
    }
}
