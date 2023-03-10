<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index() : View
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        return \view('roles.create');
    }

    public function store(Request $request)
    {
            $validated = $request->validate(['name' => ['required', 'min:3'] ]);
            Role::create($validated);

            return to_route('admin.roles.index');
    }
}
