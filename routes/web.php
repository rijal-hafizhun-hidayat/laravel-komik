<?php

use App\Http\Controllers\Komik;
use App\Http\Controllers\User;
use App\Http\Controllers\Akun;
use Illuminate\Support\Facades\Route;

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

//route login
Route::get('login', [User::class, 'index'])->name('user.index');
Route::post('sync', [User::class, 'sync'])->name('user.sync');

//route logout
Route::get('logout', [User::class, 'logOut'])->name('user.logout');

//route komik
Route::get('komik', [Komik::class, 'index'])->name('komik.index')->middleware('isLoggedIn');
Route::get('komik/create', [Komik::class, 'create'])->name('komik.create')->middleware(['isLoggedIn', 'isAdmin']);
Route::post('komik/store', [Komik::class, 'store'])->name('komik.store')->middleware(['isLoggedIn', 'isAdmin']);
Route::get('komik/destroy/{id}', [Komik::class, 'destroy'])->name('komik.destroy')->middleware(['isLoggedIn', 'isAdmin']);
Route::get('komik/show/{id}', [Komik::class, 'show'])->name('komik.show')->middleware(['isLoggedIn', 'isAdmin']);
Route::post('komik/update/{id}', [Komik::class, 'update'])->name('komik.update')->middleware(['isLoggedIn', 'isAdmin']);

//route akun
Route::get('akun', [Akun::class, 'index'])->name('akun.index')->middleware(['isLoggedIn', 'isAdmin']);
Route::get('akun/create', [Akun::class, 'create'])->name('akun.create')->middleware(['isLoggedIn', 'isAdmin']);
Route::post('akun/store', [Akun::class, 'store'])->name('akun.store')->middleware(['isLoggedIn', 'isAdmin']);
Route::get('akun/destroy/{id}', [Akun::class, 'destroy'])->name('akun.destroy')->middleware(['isLoggedIn', 'isAdmin']);
Route::get('akun/show/{id}', [Akun::class, 'show'])->name('akun.show')->middleware(['isLoggedIn', 'isAdmin']);
Route::post('akun/update/{id}', [Akun::class, 'update'])->name('akun.update')->middleware(['isLoggedIn', 'isAdmin']);

//route print komik
Route::get('print', [Komik::class, 'printKomik'])->name('komik.printKomik')->middleware(['isLoggedIn', 'isAdmin']);
