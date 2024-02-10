<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use Elastic\Elasticsearch\Client;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TagController
 *
 * @package App\Http\Controllers\Api
 */
class TagController extends Controller
{
    private readonly TagRepository $repository;

    /**
     * JobController constructor.
     */
    public function __construct(Application $app, Client $client)
    {
        parent::__construct($app);

        $this->repository = new TagRepository($client);
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
}
