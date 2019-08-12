<?php


namespace FlatFileCms\GUI\Console;

use Illuminate\Console\Command;

class SelfUpgradeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flatfilecmsgui:self:upgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrade to new version of the CMS GUI';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('flatfilecms:self:upgrade');

        system("composer require roelofjan-elsinga/flat-file-cms-gui");
    }
}