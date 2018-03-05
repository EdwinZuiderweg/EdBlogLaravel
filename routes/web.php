<?php

Route::get('edblog','Edblogcontroller@getArticles');
Route::get('edblog/filter/{catid}','Edblogcontroller@getCatArticles');

Route::get('/', function () {
    return view('welcome');
});


//Route::get('edblog', function () {
//    return view('blogpages.edblog');
//});
