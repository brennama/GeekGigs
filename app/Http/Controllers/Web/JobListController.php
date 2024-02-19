<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Generator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Class JobListController
 *
 * @package App\Http\Controllers\Web
 */
class JobListController extends Controller
{
    protected const LIMIT = 20;

    /**
     * Show job post.
     */
    public function show(Request $request): View|RedirectResponse
    {
        $subRequest = Request::create(
            sprintf('/api/jobs/%s', $request->jobId),
            'GET',
            $request->query->all(),
        );
        $subRequest->headers->set('Api-Key', config('app.api_key'));
        $response = $this->app->handle($subRequest);

        if ($response->getStatusCode() === 404) {
            // return not found
        }

        $job = Job::fromArray(
            json_decode($response->getContent(), true),
        );

        if ($job->archived && Auth::user()?->user_id !== $job->userId) {
            return redirect()->intended(config('app.url').'/jobs');
        }

        if (Auth::check()) {
            $saved = DB::table('saved_jobs')
                ->where('user_id', Auth::user()->user_id)
                ->where('job_id', $request->jobId)
                ->first();
        }

        $this->viewData['saved'] = !empty($saved);
        $this->viewData['job'] = $job;

        return view('job-view', $this->viewData);
    }
    /**
     * Show job listings.
     */
    public function search(Request $request): View
    {
        $this->viewData['jobs'] = [];
        $this->viewData['term'] = $request->query->get('term');

        if (!$request->query->has('term')) {
            return view('job-list', $this->viewData);
        }

        $request->validate(['term' => ['required']]);
        $page = (int) $request->query->get('page', 1);

        $subRequest = Request::create('/api/jobs', 'GET', $request->query->all());
        $subRequest->query->set('limit', self::LIMIT);
        $subRequest->query->set('offset', ($page - 1) * self::LIMIT);
        $subRequest->headers->set('Api-Key', config('app.api_key'));
        $response = $this->app->handle($subRequest);
        $decoded = json_decode($response->getContent(), true);

        $jobs = static function() use ($decoded): Generator {
            foreach ($decoded['hits'] as $hit) {
                $source = $hit['_source'];
                $source['id'] = $hit['_id'];
                yield Job::fromArray($source);
            }
        };

        foreach ($jobs() as $job) {
            $this->viewData['jobs'][$job->id] = $job;
        }

        $this->viewData['page'] = $page;
        $this->viewData['totalPages'] = ceil($decoded['total']['value'] / self::LIMIT);
        $this->viewData['totalResults'] = $decoded['total']['value'] ?? 0;

        return view('job-list', $this->viewData);
    }
}
