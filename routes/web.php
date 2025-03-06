<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\GradeController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Student pending verification view
    Route::get('/pending-verification', [StudentController::class, 'pending'])->name('students.pending');

    // Student profile routes
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');

    // Admin routes - we'll check admin status in the controller
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/verify-students', [StudentController::class, 'verificationList'])->name('students.verification');
    Route::post('/verify-student/{student}', [StudentController::class, 'verify'])->name('students.verify');
    
    // Subject routes
    Route::resource('subjects', SubjectController::class);
    
    // Enrollment routes
    Route::get('/enroll/student/{student}', [App\Http\Controllers\Admin\EnrollmentController::class, 'create'])
        ->name('enrollments.create');
    
    Route::post('/enroll/student/{student}', [App\Http\Controllers\Admin\EnrollmentController::class, 'store'])
        ->name('enrollments.store');
    
    Route::delete('/enroll/student/{student}/{subject}', [App\Http\Controllers\Admin\EnrollmentController::class, 'destroy'])
        ->name('enrollments.destroy');
    
    // Grade routes
    Route::get('/grades/{student}/{subject}/edit', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/grades/{student}/{subject}', [GradeController::class, 'update'])->name('grades.update');

    // Student verification routes
    Route::get('/students/verification', [StudentController::class, 'verification'])
        ->name('students.verification')
        ->middleware(['auth', 'admin']);

    Route::patch('/students/{student}/verify', [StudentController::class, 'verify'])
        ->name('students.verify')
        ->middleware(['auth', 'admin']);
});

require __DIR__.'/auth.php';
