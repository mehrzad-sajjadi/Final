<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;






Route::prefix("category")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[CategoryController::class,'index'])->name("category.index");
    Route::delete("/{category}/delete",[CategoryController::class,'delete'])->name("category.delete");
    Route::get("/{category}/show",[CategoryController::class,'show'])->name("category.show");
    Route::get("/{category}/edit",[CategoryController::class,'edit'])->name("category.edit");
    Route::put("/{category}/update",[CategoryController::class,'update'])->name("category.update");
    Route::get("/create",[CategoryController::class,'create'])->name("category.create");
    Route::post("/",[CategoryController::class,'store'])->name("category.store");
}); 


Route::prefix("post")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[PostController::class,'index'])->name("post.index");
    Route::delete("/{post}/delete",[PostController::class,'delete'])->name("post.delete");
    Route::get("/{post}/show",[PostController::class,'show'])->name("post.show");
    Route::get("/{post}/edit",[PostController::class,'edit'])->name("post.edit");
    Route::put("/{post}/update",[PostController::class,'update'])->name("post.update");
    Route::get("/create",[PostController::class,'create'])->name("post.create");
    Route::post("/",action: [PostController::class,'store'])->name("post.store");
});






Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
