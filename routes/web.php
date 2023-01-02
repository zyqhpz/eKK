<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;

use App\Http\Livewire\ProfileClub;
use App\Http\Livewire\PDFGenerator;
use App\Http\Livewire\PaperworkClub;
use App\Http\Livewire\PaperworkClubStatus;
use App\Http\Livewire\PaperworkDetailsGenerator;

use App\Http\Controllers\PaperworkController;

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

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');

    Route::get('/profile-club', ProfileClub::class)->name('profile-club');

    
    Route::get('/pdf-generator', PDFGenerator::class)->name('pdf-generator');
    // Route::post('/pdf-generator', PDFGenerator::class)->name('pdf-generator');
    // Route::post("/pdf-generator/view", [PDFGenerator::class, 'viewPDF'])->name('pdf-generator.view');
    Route::post("/pdf-generator/view", [PDFGenerator::class, 'viewPDF'])->name('view-pdf');
    
    
    // Paperwork
    // Route::get('/paperwork', [PaperworkController::class, 'index'])->name('paperwork.index');
    // Route::get('/kertas-kerja-kelab', [PaperworkController::class, 'index'])->name('paperwork.index');


    // call PaperworkClub.list method from PaperworkClub.php file when /kertas-kerja-kelab is accessed
    Route::get('/kertas-kerja-kelab', PaperworkClub::class)->name('paperwork-club');
    Route::get('/kertas-kerja-kelab/{id}', PaperworkClubStatus::class)->name('paperwork-club-status');
    Route::get('/kertas-kerja-kelab/{id}/viewPDF', [PaperworkClub::class, 'viewPDF'])->name('paperworkViewPDF');
    Route::get('/kertas-kerja-kelab/{id}/viewFinanceDetails', [PaperworkClub::class, 'viewFinanceDetails'])->name('paperworkFinanceDetails');
    // Route::get('/kertas-kerja-kelab/{id}', [PaperworkClub::class, 'show'])->name('paperwork-club-status');
    Route::get('/kertas-kerja-kelab-status', [PaperworkClub::class, 'view'])->name('paperwork-status');
    Route::post('/paperwork/create', [PaperworkClub::class, 'store'])->name('paperwork.store');
    Route::post('/paperwork/update/{id}', [PaperworkClub::class, 'update'])->name('paperwork.update');
    Route::delete('/paperwork/delete/{id}', [PaperworkClub::class, 'delete'])->name('paperwork.delete');

    // route for PDF generator
    Route::get('/kertas-kerja-kelab/{id}/paperwork-generator', PaperworkDetailsGenerator::class)->name('paperwork-generator');

    Route::get('/users', Users::class)->name('users');
    Route::get('/login-example', LoginExample::class)->name('login-example');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
});
