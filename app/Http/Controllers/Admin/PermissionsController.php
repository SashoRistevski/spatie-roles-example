<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index() : View
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return \view('permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required']]);

        Permission::create($validated);
        return to_route('admin.permissions.index');
    }
}
