<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ArchivedJob;
use App\Models\SavedJob;
use App\Repositories\JobRepository;
use Elastic\Elasticsearch\Client;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class JobSaveController
 *
 * @package App\Http\Controllers\Web
 */
class JobSaveController extends Controller
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
     * Save job.
     */
    public function save(Request $request): JsonResponse
    {
        try {
            SavedJob::create([
                'user_id' => Auth::user()->user_id,
                'job_id' => $request->request->get('id'),
                'job_title' => $request->request->get('title'),
            ]);
        } catch (Throwable) {
            return response()->json(status: 500);
        }

        return response()->json($request->all());
    }

    /**
     * Unsave job.
     */
    public function unsave(Request $request): JsonResponse
    {
        try {
             DB::table('saved_jobs')
                ->where('user_id', Auth::user()->user_id)
                ->where('job_id',  $request->request->get('id'))
                ->delete();

        } catch (Throwable) {
            return response()->json(status: 500);
        }

        return response()->json($request->all());
    }

    /**
     * Archive job.
     */
    public function archive(Request $request): JsonResponse
    {
        try {
            $document = $this->repository->find($request->request->get('id'));

            if ($document === null) {
                return response()->json(status:404);
            }

            $document->archived = true;
            $this->repository->update($document);

            DB::table('posted_jobs')
                ->where('user_id', Auth::user()->user_id)
                ->where('job_id',  $request->request->get('id'))
                ->delete();

            ArchivedJob::create([
                'user_id' => Auth::user()->user_id,
                'job_id' => $request->request->get('id'),
                'job_title' => $request->request->get('title'),
            ]);
        } catch (Throwable $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }

        return response()->json($request->all());
    }
}
