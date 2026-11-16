@extends('layouts.app')

@section('titulo', 'Página não encontrada')

@section('conteudo')
    <div style="text-align: center; padding: 3rem 0;">
        <h1>404 — Página não encontrada</h1>
        <p>A página ou o evento que procuras não existe ou foi removido.</p>
        <p><a href="{{ route('eventos.index') }}" class="botao">Voltar aos eventos</a></p>
    </div>
@endsection