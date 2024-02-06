<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
    public function show(): View
    {
        return view('home');
    }
}
