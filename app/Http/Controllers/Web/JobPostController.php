<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class JobPostController
 *
 * @package App\Http\Controllers\Web
 */
class JobPostController extends Controller
{
    /**
     * Show job post form.
     */
    public function index(): View
    {
        return view('job-post');
    }

    /**
     * Show populated job form for editing.
     */
    public function show(Request $request): View
    {
        $post = '';
        return view('job-post', ['job' => $post]);
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
