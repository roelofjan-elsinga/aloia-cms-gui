<?php

namespace AloiaCms\GUI\Tests;

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

        $password = Hash::make('password');

        $this->fs = vfsStream::setup('root', 0777, [
            'app' => [
                'accounts' => [
                    'default.json' => '{"username":"default", "password":"' . $password . '", "role":"user"}'
                ],
                'authentication' => []
            ],
            'collections' => []
        ]);

        Config::set('app.secret', env('APP_SECRET'));
        Config::set('aloiacmsgui.user_accounts_folder_path', "{$this->fs->url()}/app/accounts");
        Config::set('aloiacmsgui.authentication_tokens_folder_path', "{$this->fs->url()}/app/authentication");
        Config::set('aloiacms.collections_path', "{$this->fs->url()}/collections");
    }

    /**
     * Log in a default user to authenticate the current request
     */
    protected function authenticateRequest(): void
    {
        $token = User::getTokenForUsername('default');

        $user = User::getUserFor('default');

        User::store($token, $user);

        $this->defaultHeaders = [
            'Authorization' => "Bearer {$token}"
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class
        ];
    }
}
