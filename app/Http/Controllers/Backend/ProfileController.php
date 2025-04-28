<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\ProfileUpdateRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        $locales = collect(['ar', 'en', 'tr']);
        $countries = collect(['turkey' => 'tr', 'syria' => 'sy', 'united kingdom' => 'uk']);

        return view('dashboard.sections.profile.edit', get_defined_vars());
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->validated()
        );

        return redirect()->route('profile.edit', $user)->with('success', 'Profile updated successfully.');
    }
}
