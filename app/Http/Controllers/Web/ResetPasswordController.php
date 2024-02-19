<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Web
 */
class ResetPasswordController extends Controller
{
    /**
     * Show password reset form.
     */
    public function show(string $token): View
    {
        return view('reset-password', ['token' => $token]);
    }

    /**
     * Change password from profile.
     */
    public function change(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::min(8)
                    ->numbers()
                    ->letters()
                // ->uncompromised(),
            ],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->request->get('password'));
        $user->save();
        $request->session()->flash('status', 'Successfully updated password');

        return redirect()->back();
    }

    /**
     * Handle form submission.
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::min(8)
                    ->numbers()
                    ->letters()
                // ->uncompromised(),
            ],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function (User $user, string $password): void {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
