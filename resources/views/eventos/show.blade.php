@extends('layouts.app')

@section('titulo', $evento->titulo)

@section('conteudo')
    @if ($evento->inscritos >= $evento->vagas)
        <x-alerta tipo="aviso">Este evento está esgotado.</x-alerta>
    @endif

    <h1>{{ $evento->titulo }}</h1>
    <p><strong>Tipo:</strong> <a href="{{ route('tipos.show', $evento->tipo) }}">{{ $evento->tipo->nome }}</a></p>
    <p><strong>Data:</strong> {{ $evento->data->format('d/m/Y') }}</p>
    <p><strong>Local:</strong> {{ $evento->local }}</p>
    <p><strong>Inscritos:</strong> {{ $evento->inscritos }} de {{ $evento->vagas }}</p>

    @if ($evento->descricao)
        <p><strong>Descrição:</strong> {{ $evento->descricao }}</p>
    @endif

    <p><a href="{{ route('eventos.index') }}" class="botao">Voltar aos eventos</a></p>
@endsection