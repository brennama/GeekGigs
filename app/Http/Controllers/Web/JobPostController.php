<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

/**
 * Class JobPostController
 *
 * @package App\Http\Controllers\Web
 */
class JobPostController extends Controller
{
    protected array $viewData = ['job' => null];

    /**
     * Show job post form.
     */
    public function index(): View
    {
        // Figure out how to do the check for job variable in view
        // null coalesce not working
        return view('job-post', $this->viewData);
    }

    /**
     * Show populated job form for editing.
     *
     * @throws Throwable
     */
    public function show(string $id): View
    {
        $request = Request::create("/api/jobs/$id");
        $response = $this->app->handle($request);

        if ($response->getStatusCode() === 404) {
            // return not found
        }

        $this->viewData['job'] = Job::fromArray(
            json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR),
        );

        return view('job-post', $this->viewData);
    }

    /**
     * Create job from form.
     */
    public function create(Request $request): View
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
