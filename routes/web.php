<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rota para listar os usuários
Route::get('/', [UserController::class, 'index'])->name('users.index');

// Rota para exibir o formulário de criação de um novo usuário
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Rota para salvar um novo usuário
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Rota para exibir o formulário de edição de um usuário
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// Rota para atualizar um usuário
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Rota para deletar um usuário
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Rota para exibir os detalhes de um usuário
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::post('/users/check-cpf', [UserController::class, 'checkCpf'])->name('users.checkCpf');

