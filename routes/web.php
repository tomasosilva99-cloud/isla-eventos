<?php

use Illuminate\Support\Facades\Route;

// Array de eventos (Parte B - 6 eventos com dados de exemplo)
$eventos = [
    ['id' => 1, 'titulo' => 'Workshop de Laravel', 'tipo' => 'workshop', 'data' => '2026-10-14', 'local' => 'Laboratório 2.05', 'vagas' => 20, 'inscritos' => 12],
    ['id' => 2, 'titulo' => 'Palestra: Carreiras em Cibersegurança', 'tipo' => 'palestra', 'data' => '2026-10-21', 'local' => 'Auditório', 'vagas' => 120, 'inscritos' => 120],
    ['id' => 3, 'titulo' => 'Hackathon ISLA 24h', 'tipo' => 'hackathon', 'data' => '2026-11-06', 'local' => 'Átrio principal', 'vagas' => 60, 'inscritos' => 41],
    ['id' => 4, 'titulo' => 'Git e GitHub para iniciantes', 'tipo' => 'workshop', 'data' => '2026-09-30', 'local' => 'Laboratório 1.02', 'vagas' => 25, 'inscritos' => 25],
    ['id' => 5, 'titulo' => 'Conversa com antigos alunos DWDM', 'tipo' => 'palestra', 'data' => '2026-12-02', 'local' => 'Sala 3.10', 'vagas' => 40, 'inscritos' => 9],
    ['id' => 6, 'titulo' => 'Desenvolvimento Web com Vue.js', 'tipo' => 'workshop', 'data' => '2026-11-18', 'local' => 'Laboratório 2.01', 'vagas' => 30, 'inscritos' => 15],
];

// Rota inicial
Route::get('/', function () {
    return view('inicio');
});

// C1 & E1. Rota de listagem de eventos com filtro por query string (?tipo=...)
Route::get('/eventos', function () use ($eventos) {
    $tipo = request('tipo');
    
    if ($tipo) {
        $eventos = array_filter($eventos, fn ($evento) => $evento['tipo'] === $tipo);
    }
    
    return view('eventos.index', [
        'eventos' => $eventos,
        'tipo' => $tipo,
    ]);
});

// Desafio Autónomo: Próximos eventos (data >= hoje)
Route::get('/eventos/proximos', function () use ($eventos) {
    $hoje = date('Y-m-d');
    
    // Filtra eventos com data igual ou superior a hoje
    $proximos = array_filter($eventos, fn ($evento) => $evento['data'] >= $hoje);
    
    // Ordena do mais próximo para o mais distante
    usort($proximos, fn ($a, $b) => strtotime($a['data']) <=> strtotime($b['data']));
    
    return view('eventos.index', [
        'eventos' => $proximos,
        'tipo' => 'próximos',
    ]);
});

// D1. Rota de detalhe de um evento
Route::get('/eventos/{id}', function (int $id) use ($eventos) {
    $evento = null;
    
    foreach ($eventos as $item) {
        if ($item['id'] === $id) {
            $evento = $item;
        }
    }
    
    if ($evento === null) {
        abort(404);
    }
    
    return view('eventos.show', ['evento' => $evento]);
})->whereNumber('id');