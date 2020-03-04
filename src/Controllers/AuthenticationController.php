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
        $username = $request->get('username');
        $password = $request->get('password');

        if (User::exists($username) && User::passwordMatches($username, $password)) {
            $token = User::getTokenForUsername($username);

            $user = User::getUserFor($username);

            session()->put('Authorization', "Bearer {$token}");

            User::store($token, $user);

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
}
