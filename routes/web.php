<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::resource('/roles', RolesController::class);
    Route::post('/roles/{role}/permissions', [RolesController::class, 'addPermissionToRole'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RolesController::class, 'revokePermissionFromRole'])->name('roles.permissions.revoke');

    Route::resource('/permissions', PermissionsController::class);
    Route::post('/permissions/{permission}/roles', [PermissionsController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionsController::class, 'removeRole'])->name('permissions.roles.remove');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
