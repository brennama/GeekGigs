<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class JobListController
 *
 * @package App\Http\Controllers\Web
 */
class JobListController extends Controller
{
    /**
     * Show job listings.
     */
    public function show(): View
    {
        return view('job-list');
    }
}
