<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Class ForgotPasswordController
 *
 * @package App\Http\Controllers\Web
 */
class ForgotPasswordController extends Controller
{
    /**
     * Show password reset form.
     */
    public function show(): View
    {
        return view('forgot-password');
    }

    /**
     * Handle form submission.
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
