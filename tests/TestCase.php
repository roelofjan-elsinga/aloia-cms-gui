<?php

namespace AloiaCms\GUI\Tests;

use AloiaCms\AloiaCmsServiceProvider;
use AloiaCms\GUI\ServiceProvider;
use AloiaCms\GUI\Tests\Mocks\MockMix;
use AloiaCms\GUI\User;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
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

        $this->swap(Mix::class, new MockMix());

        $this->fs = vfsStream::setup('root', 0777, [
            'app' => [
                'authentication' => []
            ],
            'collections' => []
        ]);

        Config::set('app.secret', env('APP_SECRET'));
        Config::set('aloiacms.collections_path', "{$this->fs->url()}/collections");
    }

    protected function getPackageProviders($app)
    {
        // AloiaCmsServiceProvider is auto-discovered in a real app, but testbench
        // only boots what is listed here — and aloia-cms registers the
        // Collection::keysToSnakeCase macro its front matter writer needs.
        return [
            AloiaCmsServiceProvider::class,
            ServiceProvider::class,
        ];
    }
}
