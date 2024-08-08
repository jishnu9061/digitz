<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/25
 * Time: 10:55:21
 * Description: LoginController.php
 */

namespace App\Http\Controllers;

use App\Http\Helpers\ToastrHelper;

use App\Http\Requests\UserLoginRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login Page
     *
     * @return [type]
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Do Login
     *
     * @param UserLoginRequest $request
     *
     * @return [type]
     */
    public function login(UserLoginRequest $request)
    {
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('user.index');
        }
        return back()->with('error', 'Invalid email or password.');
    }

    /**
     * Logout User
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function logOut(Request $request)
    {
        Auth::logout();
        session()->flush();
        ToastrHelper::success('You have been logged out successfully.');
        return redirect()->route('login');
    }
}
