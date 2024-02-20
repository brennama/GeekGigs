<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\ExperienceLevel;
use App\Enums\JobType;
use App\Enums\RemotePolicy;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\PostedJob;
use App\Models\SavedJob;
use App\Repositories\JobRepository;
use Elastic\Elasticsearch\Client;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class JobController
 *
 * @package App\Http\Controllers
 */
class JobController extends Controller
{
    private readonly JobRepository $repository;

    /**
     * JobController constructor.
     */
    public function __construct(Application $app, Client $client)
    {
        parent::__construct($app);

        $this->repository = new JobRepository($client);
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate(['term' => ['required']]);

        $method = strtolower($request->get('search', 'search'));
        $method = $method === 'fuzzy' ? 'fuzzy' : 'search';

        $results = $this->repository->{$method}(
            $request->query->get('term'),
            $request->query->get('limit', 20),
            $request->query->get('offset', 0),
            $request->query->get('jobType'),
            $request->query->get('remotePolicy'),
            $request->query->get('experienceLevel'),
        );

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $job = Job::fromArray($validated);
        $job->tags = json_decode($job->tags, true);

        try {
            $this->repository->save($job);
            PostedJob::create([
                'user_id' => $validated['user_id'],
                'job_id' => $job->id,
                'job_title' => $job->title,
            ]);
        } catch (Throwable) {
            return response()->json([
                'message' => 'Internal Server Error.',
                'status' => 500,
            ], 500);
        }

        return response()->json($job);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $job = $this->repository->find($id);

        if ($job === null) {
            return response()->json([
                'message' => 'Not Found',
                'status' => 404,
            ], 404);
        }

        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $job = $this->repository->find($request->request->get('job_id'));

        if ($job === null) {
            return response()->json([
                'message' => 'Not Found',
                'status' => 404,
            ], 404);
        }

        $job->title = $validated['title'];
        $job->company = $validated['company'];
        $job->companyUrl = $validated['companyUrl'];
        $job->jobUrl = $validated['jobUrl'];
        $job->description = $validated['description'];
        $job->city = $validated['city'];
        $job->state = $validated['state'];
        $job->remotePolicy = RemotePolicy::from($validated['remotePolicy']);
        $job->experienceLevel = ExperienceLevel::from($validated['experienceLevel']);
        $job->jobType = JobType::from($validated['jobType']);
        $job->salaryRangeMin = (int) $validated['salaryRangeMin'];
        $job->salaryRangeMax = (int) $validated['salaryRangeMax'];
        $job->tags = json_decode($validated['tags'], true);

        try {
            $this->repository->update($job);
        } catch (Throwable) {
            return response()->json([
                'message' => 'Internal Server Error.',
                'status' => 500,
            ], 500);
        }

        return response()->json($job);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        PostedJob::where('job_id', $id)->delete();
        SavedJob::where('job_id', $id)->delete();

        // Add functionality to delete jobs
        return response()->json();
    }
}
