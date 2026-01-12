<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\ExamResultController as AdminExamResultController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendanceController;

use App\Http\Controllers\Admin\ClassroomController;

use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admini\App\Http\Controllers\Admin\TeachingAssignmentController;

use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\StudentSubjectController;


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('teaching-assignments', TeachingAssignmentController::class);
});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/pioneer', function () {
    return view('pioneer');
});

Route::get('/home', function () {
    return view('Home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/founder', function () {
    return view('founder');
})->name('founder');

Route::get('/events', [EventController::class, 'publicIndex'])->name('events');



/* =========================================================
   ✅ SUBJECT ROUTES (FIXED)
   ========================================================= */

// ✅ User side subject list page (this must be the ONLY /subject GET)
Route::get('/subject', [SubjectController::class, 'publicIndex'])->name('subject');

// ✅ (Optional) If you still need old subject form demo, use different URL (NO CONFLICT)
// Route::get('/subject/form', [SubjectController::class, 'showForm'])->name('subject.form');
// Route::post('/subject/submit', [SubjectController::class, 'submitForm'])->name('subject.submit');






Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

Route::get('/enroll', [EnrollController::class, 'showForm'])->name('enroll.form');
Route::post('/enroll', [EnrollController::class, 'submitForm'])->name('enroll.submit');
Route::post('/enroll', [EnrollController::class, 'store'])->name('students.store');



Route::get('/teacher', [TeacherController::class, 'showForm'])->name('teacher.form');
Route::post('/teacher', [TeacherController::class, 'submitForm'])->name('teacher.submit');


Route::get('/enroll', [EnrollController::class, 'showForm'])->name('enroll.form');
Route::post('/enroll', [EnrollController::class, 'submitForm'])->name('enroll.submit');

Route::get('/gallery', [GalleryController::class, 'index'])->name('admissions.apply');
Route::get('/gallery', [GalleryController::class, 'index']);

// Route::get('/enroll', [StudentController::class, 'create'])->name('students.create');
// Route::post('/enroll', [StudentController::class, 'store'])->name('students.store');



Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Teacher CRUD
    Route::resource('teachers', TeacherController::class);

    // Subject CRUD
    Route::resource('subjects', SubjectController::class);

    // Event CRUD
    Route::resource('events', EventController::class);
});



// frontend teacher page
Route::get('/teachers', [TeacherController::class, 'publicIndex'])->name('teachers.page');

// admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('teachers', TeacherController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('events', EventController::class);

});



// Frontend teacher page
Route::get('/teachers', [TeacherController::class, 'publicIndex'])->name('teachers.page');



// Admin side (manual)
Route::prefix('admin')->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
});

// Frontend – Dedicated & caring teachers page
Route::get('/teacher', [TeacherController::class, 'publicIndex'])->name('teacher.page');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('subjects', SubjectController::class)->except(['show']);
});







// Public/User
Route::get('/exam-results', [ExamResultController::class, 'publicIndex'])
    ->name('exam-results.public');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('exam-results', ExamResultController::class);});

 
Route::get('/attendance', [AttendanceController::class, 'index'])
    ->name('attendance.index');

Route::post('/attendance/store', [AttendanceController::class, 'store'])
    ->name('attendance.store');

//     Route::prefix('admin')->name('admin.')->middleware(['auth','is_admin'])->group(function () {
//     Route::resource('events', EventController::class);
// });

Route::get('/events', [EventController::class, 'publicIndex'])
    ->name('events.public');



Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('promotions', [PromotionController::class, 'store'])->name('promotions.store');
});




Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('students/{student}/subjects', [StudentSubjectController::class, 'create'])
        ->name('students.subjects.create');

    Route::post('students/{student}/subjects', [StudentSubjectController::class, 'store'])
        ->name('students.subjects.store');
});









