<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create() :View
    {
        return \view('permissions.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate(['guard_name' => 'web', 'name' => ['required']]);

        Permission::create($validated);
        return to_route('admin.permissions.index')->with('message', 'Permission Created successfully');
    }

    public function edit(Permission $permission): View
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission) : RedirectResponse
    {
        $validated = $request->validate(['name' => ['required']]);

        $permission->update($validated);

        return to_route('admin.permissions.index')->with('message', 'Permission Updated successfully');
    }

    public function destroy(Permission $permission) : RedirectResponse
    {
        $permission->delete();
        return back()->with('message', 'Permission Deleted successfully');
    }
}
