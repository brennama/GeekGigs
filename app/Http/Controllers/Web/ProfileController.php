<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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
        // Todo: Review this logic; middleware should take care of this
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $user->tags = json_decode($user->tags, true);

        return view('profile', [
            'user' => $user,
        ]);
    }

    public function update()
    {

    }
}
