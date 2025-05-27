<?php

namespace App\Http\Controllers\Backend;

use App\Facades\Loggy;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = Admin::Filter($request->query())->paginate(10);

        return view('dashboard.sections.admins.index', compact('admins'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $roles = $admin->roles()->get();

        return view('dashboard.sections.admins.show', compact('admin', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('dashboard.sections.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ADmin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'status'            => ['required', 'in:active,inactive,banned'],
            'roles'             => ['sometimes', 'array'],
            'roles.*'           => ['sometimes', 'exists:roles,name']
        ]);


        try {
            $admin->update(['status'         => $request->input('status')]);

            if ($request->filled('roles')) {

                $rolesIds = Role::whereIn('name', $request->input('roles'))->pluck('id')->toArray();

                $admin->roles()->sync($rolesIds);
            } else {
                $admin->roles()->detach();
            }
        } catch (Exception $e) {
            Loggy::error($e->getMessage());
            return to_route('admins.index')->with('error', $e->getMessage());
        }

        return to_route('admins.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
