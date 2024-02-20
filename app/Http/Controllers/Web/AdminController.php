<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Web
 */
class AdminController extends Controller
{
    public function show(): View|Response
    {
        if (!Auth::check() || !Auth::user()?->isAdmin) {
            return response('Not Found', 404);
        }

        return view('admin');
    }
}
