<?php

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DocumentUpsertController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('about', function() {
    return view('about');
});

Route::get('logout', [LoginController::class, 'logout']);

/* 
    Routes in the group below are accessible if use is not logged in
 */
Route::middleware('guest')->group(function() {
    Route::controller(LoginController::class)->group(function() {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'authenticate');
    });

    Route::controller(PasswordResetController::class)->group(function() {
        Route::get('forgot-password', 'showRequestForm')->name('password.request');
        Route::get('reset-password/{token}', 'showResetForm')->name('password.reset');

        Route::post('forgot-password', 'sendResetLink')->name('password.email');
        Route::patch('reset-password', 'resetPassword')->name('password.update');
    });

    Route::get('reset-password/', function() {
        abort(404);
    });
});


/*
 *  Routes in the group below requires the user to be logged in
 */
Route::middleware(['auth'])->group(function() {
    Route::get('/', function () {
        return redirect('library');
    });
    
    Route::get('library', [SearchController::class, 'showDocuments'])->name('library');

    Route::get('library/{document}', function(Document $document) {   // Shows specified document

        $url = 'documents/' . strtolower($document->program) . '/' . $document->file_name;

        if(!Storage::exists($url)) abort(404);
        
        return response()->file(Storage::path($url), ['content-type'=>'application/pdf', 'X-Content-Type-Options' => 'nosniff']);
    })->name('viewDocument');

    Route::controller(UserController::class)->group(function() {
        Route::get('account', 'showAccountSettings')->name('account');     // Shows user's account information
        Route::patch('account', 'updateInfo')->name('updateAccount');

        Route::get('account-security', 'showAccountSecurity')->name('account-security');
        Route::patch('account-security', 'updatePassword')->name('updatePassword');
    });

    
    /* 
        Routes in the group below requires the user to be an admin
    */
    Route::middleware('admin.access')->group(function() {

        /* 
            Routes in the group below start with "admin/" prefix in the URI
        */
        Route::prefix('admin')->name('admin.')->group(function() {
            Route::controller(SearchController::class)->group(function() {
                Route::get('users', 'showUsers')->name('users');
                Route::get('documents', 'showDocuments')->name('documents');
            });

            Route::controller(AdminController::class)->group(function() {
                Route::get('users/register', 'showUserRegisterForm')->name('registerUser');
                Route::get('documents/create', 'showDocumentCreateForm')->name('createDocument');
                Route::get('documents/{document}/edit', 'showDocumentEditForm')->name('editDocument');

                Route::post('users', 'registerUser');
                Route::delete('users/delete', 'deleteUser')->name('deleteUser');
                Route::patch('users/restore', 'restoreUser')->name('restoreUser');
                // Route::patch('users/update-access', 'updateAccess')->name('updateAccess');

                Route::delete('documents/delete', 'deleteDocument')->name('deleteDocument');
                Route::patch('documents/restore', 'restoreDocument')->name('restoreDocument');
            });

            Route::controller(DocumentUpsertController::class)->group(function() {
                Route::post('documents', 'uploadDocument');
                Route::patch('documents/{document}/edit', 'updateDocument')->name('updateDocument');
                Route::patch('documents/{document}/remove-author', 'removeAuthor')->name('removeAuthor');
                Route::patch('documents/{document}/add-author', 'addAuthor')->name('addAtuhor');
            });
        });
    });

    /* 
        Routes below are related to email verification
    */
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {  // Route handles verification request from emails
        $request->fulfill();
    
        return redirect('/library')->with('notification', 'Your email address has been verified!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {   // Route resends verification emails to user
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});


?>
