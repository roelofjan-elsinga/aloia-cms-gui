<?php


namespace FlatFileCms\GUI\Tests;

use AloiaCms\GUI\Tests\TestCase;
use AloiaCms\GUI\User;
use Illuminate\Http\Request;

class UserTest extends TestCase
{
    public function testCanBeInstantiatedThroughAnArray()
    {
        $user = User::fromArray(['username' => 'default']);

        $this->assertSame('default', $user->username());
    }

    public function testCanGetTokenFromUserName()
    {
        $token = User::getTokenForUsername('default');

        $this->assertNotEmpty($token);
    }

    public function testTokenIsNullWhenRequestedUserDoesNotExist()
    {
        $token = User::getTokenForUsername('defaults');

        $this->assertNull($token);
    }

    public function testPasswordCanBeMatched()
    {
        $this->assertTrue(User::passwordMatches('default', 'password'));
    }

    public function testPasswordDoesNotMatchIfUserDoesNotExist()
    {
        $this->assertFalse(User::passwordMatches('defaults', 'password'));
    }

    public function testCanGetUserInstanceFromUserName()
    {
        $user = User::getUserFor('default');

        $this->assertSame('default', $user['username']);
    }

    public function testGetNullIfUserDoesNotExistWhenRetrievingByUsername()
    {
        $user = User::getUserFor('defaults');

        $this->assertNull($user);
    }

    public function testCanVerifyIfUserExists()
    {
        $this->assertTrue(User::exists('default'));
        $this->assertFalse(User::exists('defaults'));
        $this->assertFalse(User::exists(null));
    }
}
