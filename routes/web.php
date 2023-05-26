<?php

use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/migrate', function ()
{
    Artisan::all('migrate:fresh --seed');
    echo "migrated";
});
Route::get('/', function ()
{
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/user/dashboard', function ()
{
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function ()
{
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', function ()
{
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function ()
{
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/adminAuth.php';
