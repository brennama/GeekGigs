<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Web
 */
class HomeController extends Controller
{
    public function show()
    {
        return view('welcome');
    }
}
