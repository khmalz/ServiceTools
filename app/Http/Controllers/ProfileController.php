<?php

namespace App\Http\Controllers;

use App\Actions\Client\UpdateProfile;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('dashboard.profile.edit', [
            'user' => $request->user()->load('client'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, UpdateProfile $action): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        try {
            $action->handle($user, $data);
            return to_route('dashboard')->with('success', 'Profile-updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update user. Please try again later.');
        }
    }
}
