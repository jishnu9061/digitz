<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/25
 * Time: 10:57:01
 * Description: RegisterController.php
 */

namespace App\Http\Controllers;

use App\Http\Helpers\ToastrHelper;

use App\Models\User;

use App\Http\Requests\UserRegistrationStoreRequest;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register Page
     *
     * @return [type]
     */
    public function index()
    {
        return view('pages.auth.register');
    }

    /**
     * Store Registration Details
     *
     * @param UserRegistrationStoreRequest $request
     *
     * @return [type]
     */
    public function registerUser(UserRegistrationStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        ToastrHelper::success('Successfully created user');
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
