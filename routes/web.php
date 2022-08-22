<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware("auth")->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource("categories", CategoriesController::class);
    Route::resource("tags", TagsController::class);
    Route::resource("posts", PostsController::class);
    Route::get("trashed-posts", [PostsController::class, "trashed"])->name("trashed-posts.index");
    Route::put("restore-post/{post}", [PostsController::class, "restore"])->name("restore-post");
});
