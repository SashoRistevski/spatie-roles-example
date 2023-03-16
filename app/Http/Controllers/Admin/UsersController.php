<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return \view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return \view('admin.users.role', compact('roles', 'permissions', 'user'));
    }

    public function assignRoleToUser(Request $request, User $user): RedirectResponse
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'User already that role.');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned to user');
    }

    public function removeRoleFromUser(User $user, Role $role): RedirectResponse
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role is removed');
        }
        return back()->with('message', 'Role does not exists');
    }

    public function addPermissionToUser(Request $request, User $user): RedirectResponse
    {
        if ($user->hasPermissionTo($request->permission)) {
            dd($request->permission);
            return back()->with('message', 'Permission already assigned to user.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added to User.');
    }

    public function revokePermissionFromUser(User $user, Permission $permission): RedirectResponse
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked from user');
        }
        return back()->with('message', 'Permission is not assigned to user');
    }

}
