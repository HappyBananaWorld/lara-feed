<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $feeds = \App\Models\Feed::all();

    $blogs = Blog::select('title','url')
        ->take(14)
        ->get()
    ->toArray();

    return view('blogs',compact('blogs','feeds'));
});
