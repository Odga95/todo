<?php

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
    return view('tasklist.index');
});

Route::resource('tasks', TaskController::class);
Route::get('/edit', [TaskController::class,'edit'])->name('edit');
Route::put('/tasks/{id}', [TaskController::class, 'update']);
