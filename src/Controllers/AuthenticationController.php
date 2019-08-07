<?php

namespace FlatFileCms\GUI\Controllers;

use Carbon\Carbon;
use FlatFileCms\GUI\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ReallySimpleJWT\Token;

class AuthenticationController extends Controller
{

    /**
     * Get the login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginPage()
    {
        return view('flatfilecmsgui::authentication.login');
    }

    /**
     * Attempt a login for the given request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if ($this->userExists($request->get('username')) && $this->passwordMatches($request)) {
            $user = $this->getUserFor($request->get('username'));

            $token = Token::create(
                $user['username'],
                Config::get('app.secret'),
                Carbon::now()->addHours(8)->timestamp,
                url('/')
            );

            session()->put('Authorization', "Bearer {$token}");

            $this->storeUser($token, $user);

            return Redirect::route('dashboard');
        }

        return Redirect::back()->with([
            'errors' => true
        ]);
    }

    /**
     * Attempt a logout for the given request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        User::logout($request);
        Session::remove('Authorization');

        return Redirect::route('authenticate.loginPage');
    }

    /**
     * Determine whether the user exists
     *
     * @param null|string $username
     * @return bool
     */
    private function userExists(?string $username): bool
    {
        if (is_null($username)) {
            return false;
        }

        $accounts_folder_path = Config::get('flatfilecmsgui.user_accounts_folder_path');

        return file_exists("{$accounts_folder_path}/{$username}.json");
    }

    /**
     * Determine whether the password matches
     *
     * @param Request $request
     * @return bool
     */
    private function passwordMatches(Request $request): bool
    {
        $user = $this->getUserFor($request->get('username'));

        return password_verify($request->get('password'), $user['password']);
    }

    /**
     * Get the User for the given username
     *
     * @param string $username
     * @return array
     */
    private function getUserFor(string $username): array
    {
        $accounts_folder_path = Config::get('flatfilecmsgui.user_accounts_folder_path');

        $user_json = file_get_contents("{$accounts_folder_path}/{$username}.json");

        return json_decode($user_json, true);
    }

    /**
     * Store the authentication for the given token and user
     *
     * @param string $token
     * @param array $user
     */
    private function storeUser(string $token, array $user)
    {
        file_put_contents(
            $this->getTokenFilePathForToken($token),
            json_encode($user)
        );
    }

    /**
     * Get the token file path
     *
     * @param string $token
     * @return string
     */
    private function getTokenFilePathForToken(string $token)
    {
        $path = Config::get('flatfilecmsgui.authentication_tokens_folder_path');

        return "{$path}/{$token}";
    }
}
