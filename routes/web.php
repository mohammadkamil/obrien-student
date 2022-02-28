<?php

use App\Http\Controllers\DownloadFile;
use App\Http\Controllers\Homepage;
use App\Http\Livewire\Welcome;
use App\Models\Accommodation;
use App\Models\Campus;
use App\Models\Institution;
use App\Models\Officialdoc;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'livewire.welcome.index')->middleware('auth')->name('home');
// Route::livewire('/','');
// Route::view('/', 'livewire.welcome.index')->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {
    return view('profile.show');
})->name('profile');
Route::view('survey', 'livewire.survey.index')->middleware('auth')->name('survey');
Route::view('tracerstudy', 'livewire.tracerstudy.index')->middleware('auth')->name('tracerstudy');
Route::get('/register', [Homepage::class, 'redirecttologin']);

//Route Hooks - Do not delete//
// 	Route::view('lecturers', 'livewire.lecturers.index')->middleware('auth');
// Route::view('parentprofile', 'livewire.parentprofile.index')->middleware('auth')->middleware('redirectbyrole')->name('parentprofile');
// Route::view('administration', 'livewire.administrations.index')->middleware('auth')->middleware('redirectbyrole')->name('administration');
// // Route::view('admin', 'livewire.admin.index')->middleware('auth');
// Route::view('students', 'livewire.students.index')->middleware('auth')->middleware('redirectbyrole')->name('students');
// Route::view('intake', 'livewire.intake.index')->middleware('auth')->middleware('redirectbyrole')->name('intake');
// Route::view('institutions', 'livewire.institutions.index')->middleware('auth')->name('institutions');
// Route::view('prospects', 'livewire.prospects.index')->middleware('auth')->middleware('redirectbyrole')->name('prospects');
// // Route::view('accommodations', 'livewire.accommodations.index')->middleware('auth')->name('accommodations');
// Route::view('admin', 'livewire.admin.index')->middleware('auth')->name('admin');

// Route::view('studentdocs/{id}', 'livewire.studentdocs.index')->middleware('auth')->name('studentdocs');
// Route::view('academicterms', 'livewire.academicterms.index')->middleware('auth')->middleware('redirectbyrole')->name('academicterms');
// Route::view('alumnis', 'livewire.alumnis.index')->middleware('auth')->middleware('redirectbyrole')->name('alumnis');
// Route::view('addresses', 'livewire.addresss.index')->middleware('auth')->middleware('redirectbyrole')->name('addresses');
// Route::view('{programmeid}/subjects', 'livewire.subjects.index')->middleware('auth')->name('subjects');
// // Route::view('intake', 'livewire.applications.index')->middleware('auth')->name('intake');
// Route::view('programmes', 'livewire.programmes.index')->middleware('auth')->name('programmes');
// Route::view('campuses', 'livewire.campuss.index')->middleware('auth')->name('campuses');
// Route::view('studentprofiles', 'livewire.studentprofiles.index')->middleware('auth')->middleware('redirectbyrole')->name('studentprofiles');
// Route::view('examresults', 'livewire.examresults.index')->middleware('auth')->name('examresults');
// Route::view('officialdocs', 'livewire.officialdocs.index')->middleware('auth')->middleware('redirectbyrole')->name('officialdocs');
// Route::view('prospect', 'livewire.prospect.index')->middleware('auth')->middleware('redirectbyrole')->name('prospect');
// Route::get('download/{file_name}', [DownloadFile::class, 'downloadFile'])->name('download');
// Route::get('download/studentdocs/{file_name}', [DownloadFile::class, 'downloadFile'])->name('download.student');
// Route::post('api/prospect', [Homepage::class, 'store'])->name('api.prospect');
