<?php
namespace  App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
Route::post('users-registration', [Admin\Accounts\AccountsController::class,'store'])->name('users-accounts.store');
Route::group(['middleware'=>['auth:web','routes', 'Role:user'],'except'=>'logout'],function(){
       Route::get('logout',function(){
        Session::flush();
         Auth::logout();
             return redirect('login');
         })->name('logout');
    Route::get('/', [Users\DashboardController::class, 'index'])->name('user.dashboard');
    Route::resource('users-newsFeed', Users\newsFeedsController::class)->names([
        'index' => 'users-newsFeed.list',
        'create' => 'users-newsFeed.create',
        'edit' => 'users-newsFeed.edit',
        'update' => 'users-newsFeed.update',
        'destroy' => 'users-newsFeed.destroy'
    ]);
});
