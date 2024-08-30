<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\FrontController;
use App\Http\Controllers\Web\EmployerController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\PostJobController;
use App\Http\Controllers\Web\SkillController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\AttemptQuizController;
use App\Http\Controllers\Web\ApplyNowController;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobCategoryController;


//////////////////// Admin Panel Routes ////////////////

Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin','as'=>'admin.'], function (){
    Route::get('dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::resource('jobcategories', JobCategoryController::class);
    Route::resource('quizzes', QuizController::class);
    Route::get('quizze_question/delete/{id}',[QuizController::class,'quiz_delete']);

    Route::get('candidates', [DashboardController::class,'candidates'])->name('candidates');
    Route::get('candidates/{id}/{status}', [DashboardController::class,'candidate_status']);

    Route::get('companies', [DashboardController::class,'companies'])->name('companies');
    Route::get('companies/view/{id}', [DashboardController::class,'view_company']);
    Route::get('companies/delete/{id}', [DashboardController::class,'delete_company']);
    Route::get('company/candidate-list/{id}', [DashboardController::class,'candidate_list']);
    Route::get('companies/{id}/{status}', [DashboardController::class,'company_status']);

    
});
require __DIR__.'/adminauth.php';

  


//////////////////// Frontend Routes ///////////////////
// employee
Route::group(['middleware'=>['auth','verified','usertype:1'],'prefix'=>'user','as'=>'user.'], function (){
    Route::get('account',[EmployeeController::class,'my_account'])->name('account');
    Route::get('applied-jobs',[EmployeeController::class,'applied_jobs'])->name('applied-jobs');
    Route::post('profile', [EmployeeController::class,'update_profile'])->name('profile');
    Route::get('skills', [SkillController::class,'skills'])->name('skills');
    Route::post('skills', [SkillController::class,'update'])->name('skills');
    Route::post('cv', [SkillController::class,'cv'])->name('cv');
    Route::post('comment', [CommentController::class,'comment'])->name('news.comment');
});  
// employer
Route::group(['middleware'=>['auth', 'verified','usertype:2'],'prefix'=>'company','as'=>'company.'], function (){
    Route::get('account',[EmployerController::class,'my_account'])->name('account');
    Route::post('profile', [EmployerController::class,'update_profile'])->name('user.profile');
    Route::get('posted-jobs-list',[PostJobController::class,'posted_jobs_list'])->name('posted-jobs-list');
    Route::get('post-your-job',[PostJobController::class,'post_your_job'])->name('post-your-job');
    Route::post('createjob',[PostJobController::class,'createjob'])->name('createjob');
    Route::get('editjob/{id}',[PostJobController::class,'editjob'])->name('editjob');
    Route::post('updatejob/{id}',[PostJobController::class,'updatejob'])->name('updatejob');
    Route::get('view-job-details/{slug}',[PostJobController::class,'view_job_details'])->name('view-job-details');
    Route::get('deletejob/{id}',[PostJobController::class,'deletejob'])->name('deletejob');

    Route::get('candidate-list/{id}', [PostJobController::class, 'candidate_list']);
    Route::resource('news', NewsController::class);
    Route::get('editnews/{id}',[NewsController::class,'editnews'])->name('editnews');
    Route::post('updatenews',[NewsController::class,'update'])->name('news.update');
    Route::post('comment', [CommentController::class,'comment'])->name('news.comment');
});
  

require __DIR__.'/auth.php';


Route::get('/run-migrations', function () {
    // return Artisan::call("migrate --path=/database/migrations/2023_06_22_062232_create_user_agents_table.php");
    // return Artisan::call("migrate:fresh --seed");
     return Artisan::call("storage:link", []);
});



Route::get('/',[FrontController::class,'index']);
Route::get('language/{locale}',[LanguageController::class,'change_language']);
Route::get('/companies',[FrontController::class,'companies'])->name('companies');
Route::get('/jobs',[FrontController::class,'jobs'])->name('jobs');
Route::get('/job/{slug}',[FrontController::class,'job_details'])->name('job');

Route::get('/news',[FrontController::class,'news'])->name('news');
Route::get('/quiz',[FrontController::class,'quiz'])->name('quiz');
Route::get('/guides',[FrontController::class,'guides'])->name('guides');
Route::get('company/profile/{slug}',[FrontController::class,'compnay_profile'])->name('company.profile');
Route::get('company/newz/{slug}',[FrontController::class,'company_news'])->name('company.newz');
Route::get('company/offers/{slug}',[FrontController::class,'company_offers'])->name('company.offers');


Route::get('starting-quiz-intro/{slug}',[AttemptQuizController::class,'starting_quiz_intro'])->name('starting-quiz-intro');
Route::get('start-quiz/{slug}',[AttemptQuizController::class,'start_quiz'])->name('start-quiz');
Route::post('submit-quiz/{slug}',[AttemptQuizController::class, 'submit_quiz'])->name('submit-quiz');

Route::get('job/apply-now/{slug}',[ApplyNowController::class,'apply_now'])->name('job.apply-now');
Route::post('job/apply-now/{slug}',[ApplyNowController::class,'apply_now'])->name('job.apply-now');

// Filter Search
Route::get('search',[FrontController::class,'search']);

