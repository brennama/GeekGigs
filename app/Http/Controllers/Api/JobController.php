<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreJobRequest;
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
        $results = $this->repository->search(
            $request->query->get('term'),
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
            return response()->json(status: 500);
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
            return response()->json(status: 404);
        }

        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Add functionality to update jobs
        return response()->json();
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
