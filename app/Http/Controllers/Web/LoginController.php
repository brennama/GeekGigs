<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\Web
 */
class LoginController extends Controller
{
    /**
     * Show login form.
     */
    public function show(): View
    {
        return view('login');
    }

    /**
     * Submit login form
     */
    public function submit(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember = (bool) $request->request->get('remember', false);
        $callback = static fn (User $user): bool => $user->isActive();

        if (Auth::attemptWhen($credentials, $callback, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
