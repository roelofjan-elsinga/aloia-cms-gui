<?php

namespace FlatFileCms\GUI\Tests\Console;

use FlatFileCms\GUI\Tests\TestCase;

class CreateAccountTest extends TestCase
{
    public function test_calling_command_without_username_password_results_in_prompts()
    {
        $this->artisan('flatfilecmsgui:create:account')
            ->expectsQuestion("Which username should the user have?", "testing")
            ->expectsQuestion("Which password should the user have?", "testing")
            ->expectsOutput("Created new user account: testing")
            ->assertExitCode(0);

        $this->assertTrue($this->fs->hasChild('app/accounts/testing.json'));

        $file_contents = json_decode(file_get_contents($this->fs->getChild('app/accounts/testing.json')->url()), true);

        $this->assertSame('testing', $file_contents['username']);
        $this->assertSame('user', $file_contents['role']);
        $this->assertTrue(password_verify('testing', $file_contents['password']));
    }

    public function test_calling_command_with_username_password_results_in_good_user()
    {
        $this->artisan('flatfilecmsgui:create:account', ['--username' => 'testing', '--password' => 'testing'])
            ->expectsOutput("Created new user account: testing")
            ->assertExitCode(0);

        $this->assertTrue($this->fs->hasChild('app/accounts/testing.json'));

        $file_contents = json_decode(file_get_contents($this->fs->getChild('app/accounts/testing.json')->url()), true);

        $this->assertSame('testing', $file_contents['username']);
        $this->assertSame('user', $file_contents['role']);
        $this->assertTrue(password_verify('testing', $file_contents['password']));
    }

    public function test_running_command_with_empty_username_results_in_failure()
    {
        $this->artisan('flatfilecmsgui:create:account')
            ->expectsQuestion("Which username should the user have?", "")
            ->expectsQuestion("Which password should the user have?", "")
            ->expectsOutput("You need to supply a username and password.");

        $this->assertFalse($this->fs->hasChild('app/accounts/testing.json'));
    }
}
