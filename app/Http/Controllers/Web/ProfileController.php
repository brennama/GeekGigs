<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ArchivedJob;
use App\Models\PostedJob;
use App\Models\SavedJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Web
 */
class ProfileController extends Controller
{
    /**
     * Show user profile.
     */
    public function show(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect(config('app.url').'/login');
        }

        $user = Auth::user();
        $user->tags = json_decode($user->tags, true);
        $posts = PostedJob::where('user_id', $user->user_id)->get();
        $saved = SavedJob::where('user_id', $user->user_id)->get();
        $archives = ArchivedJob::where('user_id', $user->user_id)->get();

        return view('profile', [
            'user' => $user,
            'posts' => $posts,
            'saved' => $saved,
            'archives' => $archives,
        ]);
    }

    /**
     * Update user profile.
     */
    public function update(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect(config('app.url').'/login');
        }

        $uri = sprintf('/api/users/%s', Auth::user()->user_id);
        $subRequest = Request::create($uri, 'PUT', $request->request->all());
        $subRequest->headers->set('Api-Key', config('app.api_key'));
        $response = $this->app->handle($subRequest);

        if ($response->getStatusCode() !== 200) {
            // add error message to session
        }

        $request->session()->flash('status', 'Successfully updated profile data.');

        return redirect(config('app.url').'/profile');
    }
}
