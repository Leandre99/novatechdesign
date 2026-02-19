<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apropos', fn() => view('apropos'));
Route::get('/services', fn() => view('services'));
Route::get('/projets', fn() => view('projets'));
Route::get('/recrutements', fn() => view('recrutements'));
Route::get('/contact', fn() => view('contact'));
Route::get('/candidature', fn() => view('candidature'));