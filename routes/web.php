<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ホームページを会員一覧にリダイレクト
Route::get('/' , function(){
    return redirect('/members');
});

// 会員関連のルート
// ※プレフィックス　すべてのルートのURLが/memberで始まる
Route::prefix('members')->group(function(){
    //会員一覧
    // [Route::get]でHTTPGETリクエストのルートを定義
    // ['/']は トップのURL　
    Route::get('/' , [MemberController::class , 'index'])->name('members.index');
    // 新規会員登録
    Route::get('create' , [MemberController::class , 'create'])->name('members.create');
    // 新規会員の保存
    Route::post('/' , [MemberController::class , 'store'])->name('members.store');
    // 会員情報の編集画面
    Route::get('{member}/edit' , [MemberController::class , 'edit'])->name('members.edit');
    // 会員情報の更新
    // PUTメソッドは、指定されたリソースを完全に置き換えるために使用されます
    Route::put('{member}' , [MemberController::class , 'update'])->name('members.update');
    // 会員情報の削除
    Route::delete('{member}' , [MemberController::class , 'destroy'])->name('members.destroy');

});