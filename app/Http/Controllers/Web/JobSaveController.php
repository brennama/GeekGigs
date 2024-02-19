<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SavedJob;
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
}
