<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the authentication of existing users.
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; 

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.users.index')->with('status', __('Welcome back, Admin!'));
            }

            return redirect()->intended($this->redirectPath())->with('status', __('You have successfully logged in!'));
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the post-registration redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
} 