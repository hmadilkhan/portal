<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ModuleTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    /* ADMIN ROUTES */
    Route::group(['middleware' => ['role:Super Admin']], function () {
        Route::get('register/{id?}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('get.register');
        Route::post('store-user', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name("store.register");
        Route::post('update-user', [App\Http\Controllers\Auth\RegisteredUserController::class, 'update'])->name("update.user");
        Route::post('delete-user', [App\Http\Controllers\Auth\RegisteredUserController::class, 'delete'])->name("delete.user");

        Route::get('role/{id?}', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
        Route::post('save-role', [App\Http\Controllers\RoleController::class, 'store'])->name('save.role');
        Route::post('update-role', [App\Http\Controllers\RoleController::class, 'update'])->name('update.role');
        Route::post('delete-role', [App\Http\Controllers\RoleController::class, 'delete'])->name('delete.role');

        Route::get('permission/{id?}', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
        Route::post('save-permission', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
        Route::post('update-permission', [App\Http\Controllers\PermissionController::class, 'update'])->name('update.permission');
        Route::post('delete-permission', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permission.delete');

        Route::get('role-permission/{id?}', [App\Http\Controllers\PermissionController::class, 'rolePermission'])->name('role.permission');
        Route::post('store-permission', [App\Http\Controllers\PermissionController::class, 'storeRolePermission'])->name('store.permission');
        Route::post('update-role-permission', [App\Http\Controllers\PermissionController::class, 'updateRolePermission'])->name('update.role.permission');
        Route::post('delete-role-permission', [App\Http\Controllers\PermissionController::class, 'deleteRolePermission'])->name('delete.role.permission');

        Route::get('user-permission/{id?}', [App\Http\Controllers\PermissionController::class, 'userPermission'])->name('user.permission');
        Route::post('store-user-permission', [App\Http\Controllers\PermissionController::class, 'storeUserPermission'])->name('store.user.permission');
        Route::post('update-user-permission', [App\Http\Controllers\PermissionController::class, 'updateUserPermission'])->name('update.user.permission');
        Route::post('delete-user-permission', [App\Http\Controllers\PermissionController::class, 'deleteUserPermission'])->name('delete.user.permission');

        Route::resource('tasks', TaskController::class);
    });

    Route::resource('employees', EmployeeController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('module-types', ModuleTypeController::class);

    Route::post('get-loan-terms', [App\Http\Controllers\CustomerController::class, 'getLoanTerms'])->name('get.loan.terms');
    Route::post('get-loan-aprs', [App\Http\Controllers\CustomerController::class, 'getLoanAprs'])->name('get.loan.aprs');
    Route::post('get-dealer-fee', [App\Http\Controllers\CustomerController::class, 'getDealerFee'])->name('get.dealer.fee');
    Route::post('get-redline-cost', [App\Http\Controllers\CustomerController::class, 'getRedlineCost'])->name('get.redline.cost');
    Route::post('get-sub-adders', [App\Http\Controllers\CustomerController::class, 'getSubAdders'])->name('get.sub.adders');
    Route::post('get-adders', [App\Http\Controllers\CustomerController::class, 'getAdderDetails'])->name('get.adders');
    Route::post('get-module-types', [App\Http\Controllers\CustomerController::class, 'getModulTypevalue'])->name('get.module.types');

    Route::post('project-list', [App\Http\Controllers\ProjectController::class, 'getProjectList'])->name('projects.list');
    Route::post('get-sub-departments', [App\Http\Controllers\ProjectController::class, 'getSubDepartments'])->name('get.sub.departments');
    Route::post('projects-move', [App\Http\Controllers\ProjectController::class, 'projectMove'])->name('projects.move');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
});

require __DIR__.'/auth.php';
