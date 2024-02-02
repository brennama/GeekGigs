<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class LogoutController
 *
 * @package App\Http\Controllers\Web
 */
class LogoutController extends Controller
{
    /**
     * Handle logout action.
     */
    public function redirect(Request $request): RedirectResponse
    {
        $request->session()->flush();

        return redirect()->route('login');
    }
}
