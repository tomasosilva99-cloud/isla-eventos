<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            ['titulo' => 'Workshop de Laravel', 'tipo' => 'workshop', 'data' => '2026-11-18', 'local' => 'Laboratório 2.05', 'descricao' => 'Introdução prática ao desenvolvimento web com Laravel.', 'vagas' => 20, 'inscritos' => 12],
            ['titulo' => 'Palestra: Carreiras em Cibersegurança', 'tipo' => 'palestra', 'data' => '2026-11-25', 'local' => 'Auditório', 'descricao' => 'Sessão com especialistas da área sobre saídas profissionais.', 'vagas' => 120, 'inscritos' => 120],
            ['titulo' => 'Hackathon ISLA 24h', 'tipo' => 'hackathon', 'data' => '2026-11-06', 'local' => 'Átrio principal', 'descricao' => 'Maratona de programação de 24 horas em equipa.', 'vagas' => 60, 'inscritos' => 41],
            ['titulo' => 'Git e GitHub para iniciantes', 'tipo' => 'workshop', 'data' => '2026-09-30', 'local' => 'Laboratório 1.02', 'descricao' => null, 'vagas' => 25, 'inscritos' => 25],
            ['titulo' => 'Conversa com antigos alunos DWDM', 'tipo' => 'palestra', 'data' => '2026-12-02', 'local' => 'Sala 3.10', 'descricao' => null, 'vagas' => 40, 'inscritos' => 9],
        ];

        foreach ($eventos as $evento) {
            DB::table('eventos')->insert([
                ...$evento,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}