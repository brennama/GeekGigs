<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Web
 */
class HomeController extends Controller
{
    /**
     * Show home page.
     */
    public function show(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('home');
    }
}
