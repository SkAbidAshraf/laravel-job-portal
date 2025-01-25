<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobListingController as AdminJobListingController;
use App\Http\Controllers\admin\JobTypeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\guest\HomeController;
use App\Http\Controllers\guest\UserAuthenticationController;
use App\Http\Controllers\user\AccountController;
use App\Http\Controllers\user\JobApplicationController;
use App\Http\Controllers\user\JobListingController as UserJobListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [HomeController::class, 'jobs'])->name('jobs');
Route::get('/jobs/details/{id}', [HomeController::class, 'jobDetails'])->name('jobs.details');

Route::controller(UserAuthenticationController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/registration', 'registration')->name('registration');
        Route::post('/registration/submit', 'registrationSubmit')->name('registration.submit');
        Route::get('/login', 'login')->name('login');
        Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });
});

Route::prefix('/user')->name('user.')->middleware('auth')->group(function () {
    Route::controller(JobApplicationController::class)->group(function () {
        Route::post('/apply-job', 'applyJob')->name('job.apply');
        Route::post('/save-job', 'saveJob')->name('job.save');
    });

    Route::controller(AccountController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/profile/update', 'update')->name('update');
        Route::post('/update/information', 'updateInformation')->name('update.information');
        Route::post('/update/bio', 'updateBio')->name('update.bio');
        Route::post('/update/profile-picture', 'updateProfilePic')->name('update.profilePic');
        Route::post('/update/password', 'updatePassword')->name('update.password');
    });

    Route::prefix('/jobs')->name('job.')->controller(UserJobListingController::class)->group(function () {
        Route::get('/create', 'jobCreate')->name('create');
        Route::post('/submit', 'jobSubmit')->name('submit');
        Route::get('/my-jobs', 'myJobs')->name('myJobs');
        Route::get('/edit/{jobId}', 'jobEdit')->name('edit');
        Route::get('/my-jobs/{jobId}', 'jobView')->name('view');
        Route::post('/my-jobs/{jobId}/remove-applicant', 'removeApplicant')->name('removeApplicant');
        Route::post('/update/{jobId}', 'jobUpdate')->name('update');
        Route::post('/delete', 'jobDelete')->name('delete');
        Route::get('/applied-jobs', 'appliedJobs')->name('appliedJobs');
        Route::post('/applied-job/delete', 'applicationDelete')->name('applicationDelete');
        Route::get('/saved-jobs', 'savedJobs')->name('savedJobs');
        Route::post('/saved-jobs/remove', 'removeSave')->name('removeSave');
        Route::get('/{jobId}/applicant/{userId}/details', 'applicantDetails')->name('applicant.details');
        Route::get('/{jobId}/applicant/{userId}/approve', 'approveApplication')->name('approveApplication');
    });
});

Route::middleware('admin')->prefix('/admin')->name('admin.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::prefix('/users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}/details', 'details')->name('details');
        Route::post('/delete', 'delete')->name('delete');
        Route::post('/make-admin', 'makeAdmin')->name('make.admin');
    });

    Route::prefix('/jobs')->name('jobs.')->controller(AdminJobListingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}/details', 'details')->name('details');
        Route::post('/status-update', 'statusUpdate')->name('statusUpdate');
        Route::post('/feature-update', 'updateFeatured')->name('updateFeatured');
        Route::post('/delete', 'delete')->name('delete');
    });

    Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'create')->name('create');
        Route::post('/status-update', 'statusUpdate')->name('statusUpdate');
        Route::post('/delete', 'delete')->name('delete');
    });

    Route::prefix('/job-types')->name('jobTypes.')->controller(JobTypeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'create')->name('create');
        Route::post('/status-update', 'statusUpdate')->name('statusUpdate');
        Route::post('/delete', 'delete')->name('delete');
    });
});
