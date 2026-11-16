@extends('layouts.app')

@section('titulo', $tipo->nome)

@section('conteudo')
    <h1>Eventos: {{ $tipo->nome }}</h1>

    @if (!$eventos->isEmpty())
        <div class="grelha-cartoes">
            @foreach ($eventos as $evento)
                <x-cartao-evento :evento="$evento" />
            @endforeach
        </div>
    @else
        <x-alerta tipo="aviso">Não existem eventos deste tipo.</x-alerta>
    @endif

    <p><a href="{{ route('eventos.index') }}" class="botao">Ver todos os eventos</a></p>
@endsection