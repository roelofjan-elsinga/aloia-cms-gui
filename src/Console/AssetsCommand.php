<?php


namespace AloiaCms\GUI\Console;

use Illuminate\Console\Command;

class AssetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aloiacmsgui:publish:assets';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-publish the Aloia CMS GUI assets';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'aloiacmsgui-assets',
            '--force' => true,
        ]);
    }
}
