<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

/**
 * Class JobController
 *
 * @package App\Http\Controllers\Web
 */
class JobController extends Controller
{
    public function show()
    {
        // fetch jobs from elasticsearch
        $jobs = [];

        return view('jobs', [
            'jobs' => $jobs,
        ]);
    }
}
