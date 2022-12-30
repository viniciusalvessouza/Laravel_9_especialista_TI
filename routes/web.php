<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//use app\Http\Controllers\UserController;
//use app\Http\Controllers\Admin\CommentController;

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

//nao vai ser usado, mas vou deixar aqui para saber que o breez gerou isso

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/





//esse parametro name eh para referenciar a rota nas views  

// Route::get('/users', [UserController::class,'index'])->name('users.index');

// Route::get('/users/{id}/{teste}', [UserController::class,'show'])
//     ->name('users.show');

//olha a funcao dentro da rota !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//retirar isso na "pausa"
/*
Route::get('/', function(){
    return redirect(route('users.index'));
});
*/
//crud dos usuarios

Route::prefix('/users')
    ->middleware('auth')
    ->group(

function()
{
    Route::get('/', [UserController::class,'index'])
    ->name('users.index');

    //comments
    Route::get('{id}/comments',[CommentController::class, 'index'])
        ->name('comments.index');

    Route::get('{id}/comments/create', [CommentController::class,'create'])
        ->name('comments.create');

    Route::post('{id}/comments/create', [CommentController::class,'store'])
        ->name('comments.store');

    Route::get('{userId}/comments/edit/{commentId}', [CommentController::class,'edit'])
        ->name('comment.edit');

    Route::put('{userId}/comments/edit/{commentId}', [CommentController::class,'update'])
        ->name('comment.update');

    

    //formularios
    Route::get('{id}/edit',[UserController::class,'edit']  )
        ->name('users.edit');
    Route::put('{id}/edit',[UserController::class,'update']  )
        ->name('users.update');
    //nao preciso por o /delete pois estou usando o verbo diferenciado
    Route::delete('{id}',[UserController::class,'delete'])
        ->name('users.delete');

    Route::get('/create',[UserController::class,'create'])
        ->name('users.create');

    Route::post('/',[UserController::class,'store'])
        ->name('users.store');

    //esse metodo fica no fim pq ele vai testar as outras rotas...
        //antes de seguir a rota com parametro
    Route::get('/{id}', [UserController::class,'show'])
        ->name('users.show');
});


//isso foi gerado pelo breeze mas isso ai ser usado
require __DIR__.'/auth.php';