<?php

use AloiaCms\GUI\User;

if (!function_exists('user')) {

    /**
     * Get the user from the current request
     *
     * @return User|null
     */
    function user(): ?User
    {
        return User::fromRequest(request());
    }
}
