<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        //
    }
}
