<?php

namespace FlatFileCms\GUI\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
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
        if(empty($this->option('username')) || empty($this->option('password'))) {
            $this->error('You need to supply a username and password.');
            exit(0);
        }

        $user = [
            'username' => $this->option('username'),
            'password' => bcrypt($this->option('password')),
            'role' => $this->option('role')
        ];

        $file_path = Config::get('flatfilecmsgui.user_accounts_folder_path');

        if (file_exists("{$file_path}/{$this->option('username')}.json")) {
            $this->warn("User account already exists!");
            return;
        }

        file_put_contents(
            "{$file_path}/{$this->option('username')}.json",
            json_encode($user, JSON_PRETTY_PRINT)
        );

        $this->info("Created new user account: {$this->option('username')}");
    }
}
