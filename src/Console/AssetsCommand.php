<?php


namespace FlatFileCms\GUI\Console;

use Illuminate\Console\Command;

class AssetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flatfilecms:assets';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-publish the Flat File CMS GUI assets';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'public',
            '--force' => true,
        ]);
    }
}
