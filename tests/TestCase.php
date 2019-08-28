<?php

namespace FlatFileCms\GUI\Tests;

use FlatFileCms\GUI\FlatFileCmsServiceProvider;
use Illuminate\Support\Facades\Config;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @var  vfsStreamDirectory
     */
    protected $fs;

    public function setUp(): void
    {
        parent::setUp();

        $this->fs = vfsStream::setup('root', 0777, [
            'app' => [
                'accounts' => [],
                'authentication' => []
            ]
        ]);

        Config::set('flatfilecmsgui.user_accounts_folder_path', "{$this->fs->url()}/app/accounts");
        Config::set('flatfilecmsgui.authentication_tokens_folder_path', "{$this->fs->url()}/app/authentication");
    }

    protected function getPackageProviders($app)
    {
        return [FlatFileCmsServiceProvider::class];
    }
}
