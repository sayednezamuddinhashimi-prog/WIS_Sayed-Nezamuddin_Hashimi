<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('intro',function(){
   $name='Sayed Nezamuddin Hashimi' ;
   $course='Web Information System';
   return view('home',compact('name','course'));
});


Route::get('bio',function(){
    $full_name='Sayed Nezamuddin Hashimi' ;
    $ID='R02002417';
    return view('about',compact('full_name','ID'));
 });

