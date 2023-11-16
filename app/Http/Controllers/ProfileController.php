<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

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
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'password' => ['nullable', Password::defaults()],
            'gender' => ['nullable', 'string'],
            'telephone' => ['nullable', 'numeric', 'regex:/^(62|08)[2-9][0-9]{5,20}$/'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ], [
            'telephone.regex' => 'The phone number must start with 62/08',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $request->user()->update($data);

        if ($request->telephone || $request->gender || $request->alamat) {
            $request->user()->client()->updateOrcreate(
                [],
                [
                    'telephone' => $data['telephone'] ?? null,
                    'gender' => $data['gender'] ?? null,
                    'alamat' => $data['alamat'] ?? null,
                ]
            );
        }

        return to_route('dashboard')->with('success', 'Profile-updated successfully');
    }
}
