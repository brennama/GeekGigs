<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Web
 */
class RegisterController extends Controller
{
    /**
     * Show registration page.
     */
    public function show(): View
    {
        return view('register');
    }

    /**
     * Create user from form.
     */
    public function submit(StoreUserRequest $request): RedirectResponse
    {
        $request->validated();
        $subRequest = Request::create('/api/users', 'POST', $request->request->all());
        $subRequest->headers->set('Api-Key', config('app.api_key'));
        $response = $this->app->handle($subRequest);
        $decoded = json_decode($response->getContent(), true);

        if ($response->getStatusCode() !== 200) {
            return back()->withErrors($decoded['message'])->withInput();
        }

        Auth::loginUsingId($decoded['user_id']);

        return redirect(config('app.url'));
    }
}
