<?php

namespace FlatFileCms\GUI\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flatfilecmsgui:create:account {--username=} {--password=} {--role=user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user account';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = [
            'username' => $this->option('username'),
            'password' => bcrypt($this->option('password')),
            'role' => $this->option('role')
        ];

        $file_path = "accounts/{$this->option('username')}.json";

        if (Storage::exists($file_path)) {
            $this->warn("User account already exists!");
            return;
        }

        Storage::put(
            $file_path,
            json_encode($user, JSON_PRETTY_PRINT)
        );

        $this->info("Created new user account: {$this->option('username')}");
    }
}
