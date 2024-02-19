<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\StoreJobRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
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
    public function index(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Figure out how to do the check for job variable in view
        // null coalesce not working
        return view('job-post', $this->viewData);
    }

    /**
     * Show populated job form for editing.
     *
     * @throws Throwable
     */
    public function show(string $id, Request $request): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $subRequest = Request::create("/api/jobs/$id");
        $subRequest->headers->set('Api-Key', config('app.api_key'));
        $response = $this->app->handle($subRequest);
        $decoded = json_decode($response->getContent(), true);

        if ($response->getStatusCode() === 404 || (isset($decoded['status']) && $decoded['status'] === 404)) {
            return redirect("{$request->getBaseUrl()}/post");
        }

        // Ensure post belongs to user
        if ($decoded['userId'] !== Auth::user()->user_id) {
            redirect('/profile');
        }

        $this->viewData['job'] = Job::fromArray($decoded);

        return view('job-post', $this->viewData);
    }

    /**
     * Create job from form.
     *
     * @throws Throwable
     */
    public function create(StoreJobRequest $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $subRequest = Request::create('/api/jobs', 'POST', $request->request->all());
        $subRequest->headers->set('Api-Key', config('app.api_key'));
        $response = $this->app->handle($subRequest);
        $decoded = json_decode($response->getContent(), true);
        $request->session()->flash(
            'status', "Successfully posted job.<br>" .
            "<a href=\"{$request->getBaseUrl()}/jobs/{$decoded['id']}\" target=\"_blank\">View the job posting for {$decoded['title']}</a>",
        );

        return redirect($request->fullUrl());
    }

    public function update()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    }

    public function delete()
    {

    }
}
