<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return \view('permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required']]);

        Permission::create($validated);
        return to_route('admin.permissions.index')->with('message', 'Permission Created successfully');
    }

    public function edit(Permission $permission): View
    {
        $roles = Role::all();
        return view('permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required']]);

        $permission->update($validated);

        return to_route('admin.permissions.index')->with('message', 'Permission Updated successfully');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return back()->with('message', 'Permission Deleted successfully');
    }

    public function assignRole(Request $request, Permission $permission): RedirectResponse
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }
        $permission->assignRole($request->role);
        return back()->with('message', 'Role assigned');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role))
        {
            $permission->removeRole($role);
            return back()->with('message', 'Role is removed');
        }
        return back()->with('message', 'Role does not exists');
    }
}
