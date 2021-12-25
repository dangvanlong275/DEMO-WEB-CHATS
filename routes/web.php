<?php

use App\Events\Chats;
use App\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/index', "ChatroomController@indexChat");
    Route::get('/room/{id}', "ChatroomController@index");
    Route::post('/send-message', "MessageController@store");
    Route::post('/create-room-private',"ChatroomController@createChatRoom")->name('room_private');
    Route::post('/create-room-group',"ChatroomController@createGroupChatRoom")->name('room_group');
    Route::post('/delete-member',"ChatroomController@deleteMember")->name('delete_member');
    Route::get('/add-member-room',"ChatroomController@addMemberRoom");
    Route::get('/search-user',"UserController@searchFriend");
    Route::get('/search-add-user',"UserController@searchUser");
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('redirect/{driver}', 'LoginController@redirectToProvider')
    ->name('login.provider');
Route::get('/auth/{driver}/callback', "LoginController@handleProviderCallback");
