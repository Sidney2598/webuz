<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Front\Controller as FrontController;
use App\Http\Controllers\Front\Categories\Controller as CategoriesController;
use App\Http\Controllers\Front\Members\Controller as MembersController;
use App\Http\Controllers\Front\Vote\Controller as VoteController;
use App\Http\Controllers\Front\Himoya\Controller as HimoyaController;
use App\Http\Controllers\Front\Roles\Controller as RoleController;
use App\Http\Controllers\Front\Permissions\Controller as PermissionController;
use App\Http\Controllers\Front\RoleHas\Controller as RoleHasController;
use App\Http\Controllers\Front\Calclus\Controller as CalclusController;
use App\Http\Controllers\Front\VoteMemebers\Controller as VMController;
use App\Http\Controllers\Front\PermissionHas\Controller as PermissionHasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::post('/login', 'LoginController@login')->name('login');
// Route::post('/logout', 'LoginController@logout')->name('logout');

 Route::namespace('Front')->middleware(['auth','role:superadmin|moderator|member|user','admin'])->prefix('/')->group(function (){
     Route::get('/',[FrontController::class,'index'])->name('index');
     Route::get('/status',[FrontController::class,'status'])->name('status');
     Route::namespace('Categories')->prefix('/categories')->middleware('permission:superadmin|moderator')->group(function (){
        Route::get('/',[CategoriesController::class,'index'])->name('categories');
        Route::get('/create',[CategoriesController::class,'create'])->name('categories.create');
        Route::post('/store',[CategoriesController::class,'store'])->name('categories.store');
        Route::get('/edit/{categories}',[CategoriesController::class,'edit'])->name('categories.edit');
        Route::put('/update',[CategoriesController::class,'update'])->name('categories.update');
        Route::get('/destroy/{categories}',[CategoriesController::class,'destroy'])->name('categories.delete');
    });
    Route::namespace('Members')->prefix('/members')->middleware('permission:superadmin|moderator')->group(function (){
        Route::get('/',[MembersController::class,'index'])->name('members');
        Route::get('/create',[MembersController::class,'create'])->name('members.create');
        Route::post('/store',[MembersController::class,'store'])->name('members.store');
        Route::get('/edit/{user}',[MembersController::class,'edit'])->name('members.edit');
        Route::put('/update',[MembersController::class,'update'])->name('members.update');
        Route::get('/destroy/{user}',[MembersController::class,'delete'])->name('members.delete');
        Route::get('/degre/{degre_id}/{id}',[MembersController::class,'degre'])->name('members.degre1');
        Route::get('/degre2/{degre_id}/{id}',[MembersController::class,'degre2'])->name('members.degre2');
    });
    Route::namespace('Vote')->prefix('/vote')->group(function (){
        Route::get('/',[VoteController::class,'index'])->name('vote');
        Route::get('/create',[VoteController::class,'create'])->name('vote.create')->middleware('permission:superadmin|moderator');
        Route::post('/store',[VoteController::class,'store'])->name('vote.store')->middleware('permission:superadmin|moderator');
        Route::get('/send/{vote}',[VoteController::class,'edit'])->name('vote.send')->middleware('permission:superadmin|moderator');
        Route::get('/sends/{vote}',[VoteController::class,'editend2'])->name('vote.send2')->middleware('permission:superadmin|moderator');
        Route::get('/senttwo/{vote}',[VoteController::class,'editend3'])->name('vote.send3')->middleware('permission:superadmin|moderator');
        Route::get('/destroy/{vote}',[VoteController::class,'destroy'])->name('vote.delete')->middleware('permission:superadmin|moderator');  
    });
    Route::namespace('Himoya')->prefix('/himoya')->group(function (){
        Route::get('/',[HimoyaController::class,'index'])->name('himoya');
        Route::get('/wordexport/{vote}',[HimoyaController::class,'export'])->name('wordexport');
        Route::get('/kuntartibi',[HimoyaController::class,'kuntartibi'])->name('kuntartibi');
        Route::get('/yakunlash/{id}',[HimoyaController::class,'yakunlash'])->name('yakunlash');
        Route::get('/himoyas/{vote}/{status}',[HimoyaController::class,'himoya2'])->name('himoya2');
        Route::get('/delete/{vote}',[HimoyaController::class,'delete'])->name('himoya.delete');
    });
    Route::namespace('Roles')->prefix('/roles')->middleware('permission:superadmin')->group(function(){
        Route::get('/',[RoleController::class,'index'])->name('roles');
        Route::get('/create',[RoleController::class,'create'])->name('roles.create');
        Route::post('/store',[HimoyaController::class,'store'])->name('roles.store');
        Route::get('/edit/{roles}',[HimoyaController::class,'edit'])->name('roles.edit');
        Route::put('/update',[HimoyaController::class,'update'])->name('roles.update');
        Route::get('/destroy/{roles}',[HimoyaController::class,'delete'])->name('roles.delete');
    });
    Route::namespace('Permissions')->prefix('/permission')->middleware('permission:superadmin')->group(function(){
        Route::get('/',[PermissionController::class,'index'])->name('permission');
        Route::get('/create',[PermissionController::class,'create'])->name('permission.create');
        Route::post('/store',[PermissionController::class,'store'])->name('permission.store');
        Route::get('/edit/{permissions}',[PermissionController::class,'edit'])->name('permission.edit');
        Route::put('/update',[PermissionController::class,'update'])->name('permission.update');
        Route::get('/destroy/{permissions}',[PermissionController::class,'destroy'])->name('permission.delete');
    });
    Route::namespace('RoleHas')->prefix('/rolehas')->middleware('permission:superadmin')->group(function(){
        Route::get('/',[RoleHasController::class,'index'])->name('rolehas');
        Route::get('/create',[RoleHasController::class,'create'])->name('rolehas.create');
        Route::post('/store',[RoleHasController::class,'store'])->name('rolehas.store');
        Route::get('/edit/{role_id}/{user}',[RoleHasController::class,'edit'])->name('rolehas.edit');
        Route::put('/update',[RoleHasController::class,'update'])->name('rolehas.update');
        Route::get('/destroy/{rolehas}',[RoleHasController::class,'destroy'])->name('rolehas.delete');
    });
    Route::namespace('PermissionHas')->prefix('/permissionhas')->middleware('permission:superadmin')->group(function(){
        Route::get('/',[PermissionHasController::class,'index'])->name('permissionhas');
        Route::get('/create',[PermissionHasController::class,'create'])->name('permissionhas.create');
        Route::post('/store',[PermissionHasController::class,'store'])->name('permissionhas.store');
        Route::get('/edit/{permissionhas}',[PermissionHasController::class,'edit'])->name('permissionhas.edit');
        Route::put('/update',[PermissionHasController::class,'update'])->name('permissionhas.update');
        Route::get('/destroy/{permissionhas}',[PermissionHasController::class,'destroy'])->name('permissionhas.delete');
    });
 });
 Auth::routes();
 Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
});

