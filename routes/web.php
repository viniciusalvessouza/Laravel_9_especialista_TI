<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//esse parametro name eh para referenciar a rota nas views  

// Route::get('/users', [UserController::class,'index'])->name('users.index');

// Route::get('/users/{id}/{teste}', [UserController::class,'show'])
//     ->name('users.show');

//olha a funcao dentro da rota !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//retirar isso na "pausa"
Route::get('/', function(){
    return redirect(route('users.index'));
});

//crud dos usuarios
Route::group([
    'prefix'=>'/users'
],
function(){

    Route::get('/', [UserController::class,'index'])
        ->name('users.index');

    //formularios
    Route::get('{id}/edit',[UserController::class,'edit']  )->name('users.edit');
    Route::put('{id}/edit',[UserController::class,'update']  )->name('users.update');
    //nao preciso por o /delete pois estou usando o verbo diferenciado
    Route::delete('{id}',[UserController::class,'delete'])->name('users.delete');

    Route::get('/create',[UserController::class,'create'])->name('users.create');

    Route::post('/',[UserController::class,'store'])->name('users.store');

    //esse metodo fica no fim pq ele vai testar as outras rotas...
        //antes de seguir a rota com parametro
    Route::get('/{id}', [UserController::class,'show'])
        ->name('users.show');
    });