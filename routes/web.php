<?php

use App\Models\Listing;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;

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

// Show all quizzes
Route::get('/', [QuizzeController::class, 'index']);

// Show Create Quiz Form
Route::get('quizzes/create', [QuizzeController::class, 'create'])
->middleware('auth');

// Store Quiz
Route::post('quizzes', [QuizzeController::class, 'storeConfig'])
->middleware("auth");

// Show Manage Quizzes Page
Route::get('/quizzes/manage', [QuizzeController::class, 'manage'])
->middleware('auth');

// Show Edit Form
Route::get('/quizzes/{quizze}/edit', [QuizzeController::class, 'edit'])
->middleware('auth');

// Show Edit Config Form
Route::get('/quizzes/{quizze}/editConfig', [QuizzeController::class, 'editConfig'])
->middleware('auth');

// Show Responses of a specific quizz
Route::get('/quizzes/{quizze}/viewResponses/{responseUserID}', [QuizzeController::class, 'viewResponses'])
->middleware('auth');

// Update Quizz
Route::put('/quizzes/{quizze}', [QuizzeController::class, 'updateConfig'])
->middleware('auth');

// Delete Quizz
Route::delete('/quizzes/{quizze}', [QuizzeController::class, 'destroy'])
->middleware('auth');

// Show one quizz
Route::get('/quizzes/{quizze}', [QuizzeController::class, 'show']);


// Store Question in Current Quiz
Route::post('/questions', [QuestionController::class, 'store'])
->middleware("auth");

// Show Create Question Form
Route::get('/questions/create', [QuestionController::class, 'create'])
->name('/questions/create');

// Delete Question
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])
->middleware('auth');

// Store Question in Current Quiz
Route::post('/responses', [ResponseController::class, 'store'])
->middleware("auth");

// View Response
Route::get('/responses/viewResponse', [ResponseController::class, 'show']);

// Show Register Form
Route::get('/register', [UserController::class, 'create'])
->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])
->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')
->middleware('guest');

// Log User In
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
