<?php

namespace AloiaCms\GUI;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ReallySimpleJWT\Token;

class User
{
    private $user;

    private function __construct(array $user)
    {
        $this->user = $user;
    }

    /**
     * Create a user instance from an array
     *
     * @param array $user
     * @return User
     */
    public static function fromArray(array $user): User
    {
        return new static($user);
    }

    /**
     * Create a user instance from a Request
     *
     * @param Request $request
     * @return User|null
     */
    public static function fromRequest(Request $request): ?User
    {
        if (!self::hasAuthorizationHeaders($request)) {
            return null;
        }

        $token = self::getTokenFromHeaders($request);

        if (! self::hasValidToken($token)) {
            return null;
        }

        $token_path = Config::get('aloiacmsgui.authentication_tokens_folder_path');

        if (! file_exists("{$token_path}/{$token}")) {
            return null;
        }

        $user = json_decode(file_get_contents("{$token_path}/{$token}"), true);

        return new static($user);
    }

    /**
     * Determine if the request headers contain Authorization headers
     *
     * @param Request $request
     * @return bool
     */
    private static function hasAuthorizationHeaders(Request $request): bool
    {
        return $request->session()->has('Authorization') || $request->header('Authorization', false);
    }

    /**
     * Get the user token from the request headers
     *
     * @param Request $request
     * @return string
     */
    private static function getTokenFromHeaders(Request $request): string
    {
        $headers = $request->session()->get('Authorization') ?? $request->header('Authorization');

        return str_replace('Bearer ', '', $headers);
    }

    /**
     * @param string $token
     * @return bool
     */
    private static function hasValidToken(string $token): bool
    {
        return Token::validate($token, config('app.secret'));
    }

    /**
     * Get the username of this user
     *
     * @return string
     */
    public function username(): string
    {
        return $this->user['username'];
    }

    /**
     * Get the authentication token for the user with the given username
     *
     * @param string $username
     * @return string
     */
    public static function getTokenForUsername(string $username): ?string
    {
        if (!self::exists($username)) {
            return null;
        }

        $user = static::getUserFor($username);

        return Token::create(
            $user['username'],
            Config::get('app.secret'),
            Carbon::now()->addHours(8)->timestamp,
            url('/')
        );
    }

    /**
     * Determine whether the password matches
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function passwordMatches(string $username, string $password): bool
    {
        if (!self::exists($username)) {
            return false;
        }

        $user = self::getUserFor($username);

        return password_verify($password, $user['password']);
    }

    /**
     * Get the User for the given username
     *
     * @param string $username
     * @return array
     */
    public static function getUserFor(string $username): ?array
    {
        if (!self::exists($username)) {
            return null;
        }

        $accounts_folder_path = Config::get('aloiacmsgui.user_accounts_folder_path');

        $user_json = file_get_contents("{$accounts_folder_path}/{$username}.json");

        return json_decode($user_json, true);
    }

    /**
     * Determine whether the user exists
     *
     * @param null|string $username
     * @return bool
     */
    public static function exists(?string $username): bool
    {
        if (is_null($username)) {
            return false;
        }

        $accounts_folder_path = Config::get('aloiacmsgui.user_accounts_folder_path');

        return file_exists("{$accounts_folder_path}/{$username}.json");
    }

    /**
     * Store the authentication for the given token and user
     *
     * @param string $token
     * @param array $user
     */
    public static function store(string $token, array $user)
    {
        $file_path = self::getTokenFilePath();

        if (!file_exists($file_path)) {
            mkdir($file_path, 0777, true);
        }

        file_put_contents(
            "{$file_path}/{$token}",
            json_encode($user)
        );
    }

    /**
     * Get the token file path
     *
     * @param string $token
     * @return string
     */
    private static function getTokenFilePath()
    {
        return Config::get('aloiacmsgui.authentication_tokens_folder_path');
    }

    /**
     * Logout this user
     *
     * @param Request $request
     * @return null
     */
    public static function logout(Request $request)
    {
        if (!self::hasAuthorizationHeaders($request)) {
            return null;
        }

        $token = self::getTokenFromHeaders($request);

        if (! self::hasValidToken($token)) {
            return null;
        }

        try {
            $token_path = Config::get('aloiacmsgui.authentication_tokens_folder_path');

            File::delete("{$token_path}/{$token}");
        } catch (\Exception $exception) {
            // Already deleted
        }
    }
}
