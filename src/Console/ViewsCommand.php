<?php

namespace FlatFileCms\GUI\Console;

use Illuminate\Console\Command;

class ViewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flatfilecmsgui:publish:views';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-publish the Flat File CMS GUI views';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'views',
            '--force' => true,
        ]);
    }
}
