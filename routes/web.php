<?php

Route::get('edblog','Edblogcontroller@getArticles');
Route::get('edblog/filter/{catid}','Edblogcontroller@getCatArticles');
Route::get('edblog/alles/','Edblogcontroller@getAllArticles');
Route::get('edblog/zoek/{zoekfilter}','Edblogcontroller@getZoekArticles');
Route::post('edblog/posts/','Edblogcontroller@storereaction');



Route::get('/', function () {
    return view('welcome');
});


//Route::get('edblog', function () {
//    return view('blogpages.edblog');
//});
