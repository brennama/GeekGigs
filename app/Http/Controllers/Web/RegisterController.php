<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Web
 */
class RegisterController extends Controller
{
    /**
     * Show registration page.
     */
    public function show(): View
    {
        return view('register');
    }

    public function submit()
    {

    }
}
