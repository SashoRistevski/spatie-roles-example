<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(): View
    {
        $roles = Role::whereNotIn('name', ['admin', 'SuperAdmin'])->get();
        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('roles.create');
    }

    public function edit(Role $role) : View
    {
        return view('roles.edit', compact('role'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        return to_route('admin.roles.index')->with('message', 'Role Created successfully!');
    }

    public function update(Request $request, Role $role) : RedirectResponse
    {
        $validated = $request->validate(['name' => 'required', 'min:3']);
        $role->update($validated);

        return to_route('admin.roles.index')->with('message', 'Role Updated successfully!');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return back()->with('message', 'Role Deleted successfully!');
    }
}
