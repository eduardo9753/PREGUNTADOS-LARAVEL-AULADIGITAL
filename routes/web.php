<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Rankcontroller;
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

/*Route::get('/', function () {
    return view('game.index');
}); */

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'login'])->name('login.auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home/game', [GameController::class, 'home'])->name('game.home');
Route::get('/game/ruleta', [GameController::class, 'ruleta'])->name('game.ruleta');
Route::get('/game/save/score/single/{correct}', [GameController::class , 'scoreSingle'])->name('game.scoreSingle');
Route::get('/game/{category_id}', [GameController::class, 'index'])->name('game.index');
Route::get('/game/manager/{user_id}', [GameController::class, 'manager'])->name('game.manager');
Route::post('/game/create', [GameController::class, 'create'])->name('game.create');
Route::get('/game/wait/{game_id}', [GameController::class, 'wait'])->name('game.wait');
Route::get('/game/play/{game_id}', [GameController::class, 'play'])->name('game.play');

Route::get('/game/select/avatar', [AvatarController::class , 'index'])->name('game.avatar.index');

Route::get('/game/rank/user', [Rankcontroller::class , 'index'])->name('game.rank.show');
Route::get('/game/rankig/top10', [Rankcontroller::class , 'ranking'])->name('game.rank.ranking');
Route::get('/game/reglas/del-juego', [Rankcontroller::class , 'rule'])->name('game.rank.rule');