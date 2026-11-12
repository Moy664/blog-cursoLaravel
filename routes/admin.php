<?php

use Illuminate\Support\Facades\Route;

Route::get("/",function(){
    return "Hello admin";
})->name("dashboard");

Route::get("/cursos",function(){
    return "Cursos";
})->name("cursos");