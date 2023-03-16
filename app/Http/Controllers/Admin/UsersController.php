<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index() : View
    {
        $users = User::all();
        return \view('admin.users.index', compact('users'));
    }
}
