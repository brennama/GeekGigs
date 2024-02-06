<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Repositories\JobRepository;
use Elastic\Elasticsearch\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class JobController
 *
 * @package App\Http\Controllers
 */
class JobController extends Controller
{
    private JobRepository $repository;

    /**
     * JobController constructor.
     */
    public function __construct(Client $client)
    {
        $this->repository = new JobRepository($client);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->show(1);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $job = $this->repository->find($id);

        if ($job === null) {
            return response()->json(status: 404);
        }

        return response()->json($job->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
