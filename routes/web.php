<?php

use App\Models\User;
use App\Models\Contact;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/sample', function () {
    $id = 1;

        $name = 'hr';

        $contact = Contact::where('user', $id)->pluck('contact');
        // dd($contact);
        $user = User::where('fname','LIKE', "%{$name}%")
        			->orWhere('lname', 'LIKE', "%{$name}%")
        			->whereNotIn('id', $contact )
        			->get();

       dd($user);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact-list', [App\Http\Controllers\HomeController::class, 'contactList']);
Route::post('/search-user', [App\Http\Controllers\ContactController::class, 'searchUser']);
Route::post('/add-user', [App\Http\Controllers\ContactController::class, 'addUser']);
Route::post('/fetch-contact', [App\Http\Controllers\ContactController::class, 'fetchContact']);
Route::post('/delete-contact', [App\Http\Controllers\ContactController::class, 'deleteContact']);
Route::post('/compose-message', [App\Http\Controllers\MessageController::class, 'composeMessage']);
Route::post('/get-message', [App\Http\Controllers\MessageController::class, 'getMessage']);
Route::post('/send-message', [App\Http\Controllers\MessageController::class, 'sendMessage']);
