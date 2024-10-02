<?php

use App\Http\Controllers\FeriasController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\RecrutamentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('sair',function(){
    Auth::logout();
    return view('auth.login');
})->name('sair');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', function(){
        $nome = 56;
        //return view('page.inicio',['nome'=>$nome]);
        return view('page.inicio',compact('nome'));
    });

    Route::get('user',[UserController::class,'index'])->name('usuario');
    Route::post('user',[UserController::class,'store'])->name('user.store');
    Route::get('apagar/{id}',[UserController::class, 'apagar'])->name('user.apagar');
    //Routas para Funcionario
    Route::get('funcionario',[FuncionarioController::class,'index'])->name('funcionario');
    Route::post('funcionario',[FuncionarioController::class,'store'])->name('funcionario.store');
    Route::get('apagar/{id}/funcionario',[FuncionarioController::class, 'apagar'])->name('funcionario.apagar');
    //Routas para Recrutamento
    Route::get('recrutamento',[RecrutamentoController::class,'index'])->name('recrutamento');
    Route::post('recrutamento',[RecrutamentoController::class,'store'])->name('recrutamento.store');
    Route::get('apagar/{id}/recrutamento',[RecrutamentoController::class, 'apagar'])->name('recrutamento.apagar');
     //Routas para Ferias
     Route::get('ferias',[FeriasController::class,'index'])->name('ferias');
     Route::post('ferias',[FeriasController::class,'store'])->name('ferias.store');
     Route::get('apagar/{id}/ferias',[FeriasController::class, 'apagar'])->name('ferias.apagar');
     Route::get('aprovado/{id}',[FeriasController::class, 'aprovado'])->name('ferias.aprovado');
     Route::get('recusado/{id}',[FeriasController::class, 'recusado'])->name('ferias.recusado');
});

Auth::routes();

Route::get('/home', function(){
    return redirect('/');
})->name('home');
