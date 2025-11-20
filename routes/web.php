<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $f =     app(\App\Services\FetchFeedContentsService::class);
    $data = $f->fetch();

    return $data;
//    return response()->json([
//        'items'=>$data['channel']['item'],
//        'data'=>$data
//    ]);
});
