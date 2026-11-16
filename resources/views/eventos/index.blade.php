@extends('layouts.app')

@section('titulo', 'Eventos')

@section('conteudo')
    <h1>Eventos {{ $tipo ? '(' . e($tipo) . ')' : '' }}</h1>

    <nav>
        <ul>
            <li><a href="{{ route('eventos.index') }}">Todos</a></li>
            <li><a href="{{ route('eventos.index', ['tipo' => 'workshop']) }}">Workshops</a></li>
            <li><a href="{{ route('eventos.index', ['tipo' => 'palestra']) }}">Palestras</a></li>
            <li><a href="{{ route('eventos.index', ['tipo' => 'hackathon']) }}">Hackathons</a></li>
        </ul>
    </nav>

    @if (!$eventos->isEmpty())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Evento</th>
                    <th>Data</th>
                    <th>Vagas livres</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('eventos.show', $evento->id) }}">{{ $evento->titulo }}</a>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                        <td>
                            @if ($evento->inscritos >= $evento->vagas)
                                <strong>Esgotado</strong>
                            @else
                                {{ $evento->vagas - $evento->inscritos }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <x-alerta tipo="aviso">Não há eventos para mostrar.</x-alerta>
    @endif

    <p><a href="{{ route('inicio') }}">Voltar à página inicial</a></p>
@endsection