<?php

namespace App\Http\Controllers\Backend;

use App\Facades\Loggy;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::Filter($request->query())->paginate(10);

        return view('dashboard.sections.users.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = $user->roles()->get();

        return view('dashboard.sections.users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.sections.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'status'            => ['required', 'in:active,inactive,banned'],
            'roles'             => ['sometimes', 'array'],
            'roles.*'           => ['sometimes', 'exists:roles,name']
        ]);


        try {
            $user->update(['status'         => $request->input('status')]);

            if ($request->filled('roles')) {

                $rolesIds = Role::whereIn('name', $request->input('roles'))->pluck('id')->toArray();

                $user->roles()->sync($rolesIds);
            } else {
                $user->roles()->detach();
            }
        } catch (Exception $e) {
            Loggy::error($e->getMessage());
            return to_route('users.index')->with('error', $e->getMessage());
        }

        return to_route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
