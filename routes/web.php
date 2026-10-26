<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// B1. Duas rotas de texto
Route::get('/ola', function () {
    return 'Olá, DWDM!';
});

// B1 & C1. Rota /sobre devolvendo a view
Route::get('/sobre', function () {
    return view('sobre');
});

// B2. Um parâmetro protegido com e()
Route::get('/ola/{nome}', function (string $nome) {
    return 'Olá, ' . e($nome) . '!';
});

// B3. Dois parâmetros
Route::get('/aluno/{nome}/{curso}', function (string $nome, string $curso) {
    return e($nome) . ' está no curso ' . e($curso) . '.';
});

// B4. Um parâmetro opcional
Route::get('/saudacao/{nome?}', function (?string $nome = null) {
    return 'Bem-vindo, ' . e($nome ?? 'visitante') . '!';
});

// B5. Só aceita números
Route::get('/dobro/{numero}', function ($numero) {
    return 'O dobro de ' . $numero . ' é ' . ($numero * 2);
})->whereNumber('numero');


// Array de interesses partilhado para a Parte C e Desafio
$interesses = ['Laravel', 'MySQL', 'Git'];

// C2 & C3 & C4. Rota /perfil
Route::get('/perfil', function () use ($interesses) {
    return view('perfil', [
        'nome' => 'Ana Costa',
        'curso' => 'DWDM',
        'ano' => 2,
        'interesses' => $interesses,
    ]);
});

// Desafio Autónomo
Route::get('/perfil/{interesse}', function (string $interesse) use ($interesses) {
    if (in_array($interesse, $interesses)) {
        return e($interesse) . ' está na minha lista de interesses.';
    }
    return e($interesse) . ' não está na minha lista de interesses.';
});