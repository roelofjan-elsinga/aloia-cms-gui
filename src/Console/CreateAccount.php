<?php

namespace FlatFileCms\GUI\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

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
        $user_name = $this->option('username');
        $password = $this->option('password');

        if (empty($user_name)) {
            $user_name = $this->ask("Which username should the user have?");
        }

        if (empty($password)) {
            $password = $this->ask("Which password should the user have?");
        }

        if (empty($user_name) || empty($password)) {
            $this->error('You need to supply a username and password.');
            return;
        }

        $user = [
            'username' => $user_name,
            'password' => bcrypt($password),
            'role' => $this->option('role')
        ];

        $file_path = Config::get('flatfilecmsgui.user_accounts_folder_path');

        if (file_exists("{$file_path}/{$user_name}.json")) {
            $this->warn("User account already exists!");
            return;
        }

        file_put_contents(
            "{$file_path}/{$user_name}.json",
            json_encode($user, JSON_PRETTY_PRINT)
        );

        $this->info("Created new user account: {$user_name}");
    }
}
