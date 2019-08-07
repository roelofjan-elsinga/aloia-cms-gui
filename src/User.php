<?php

namespace FlatFileCms\GUI;

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

        if (! Storage::exists("authentication/{$token}")) {
            return null;
        }

        $user = json_decode(Storage::get("authentication/{$token}"), true);

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
        return $request->session()->has('Authorization');
    }

    /**
     * Get the user token from the request headers
     *
     * @param Request $request
     * @return string
     */
    private static function getTokenFromHeaders(Request $request): string
    {
        $headers = $request->session()->get('Authorization');

        $token = str_replace('Bearer ', '', $headers);

        return $token;
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
            $token_path = Config::get('flatfilecmsgui.authentication_tokens_folder_path');

            File::delete("{$token_path}/{$token}");
        } catch (\Exception $exception) {
            // Already deleted
        }
    }
}
