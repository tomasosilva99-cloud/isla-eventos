@extends('layouts.app')

@section('titulo', 'Início')

@push('estilos')
<style>
    .etiqueta-workshop { background-color: #dbeafe; color: #1e40af; }
    .etiqueta-palestra { background-color: #fef3c7; color: #92400e; }
    .etiqueta-hackathon { background-color: #dcfce7; color: #166534; }
</style>
@endpush

@section('conteudo')
    <h1>{{ config('app.name') }}</h1>
    <p>Workshops, palestras e hackathons do ISLA Gaia.</p>
    <p><a href="{{ route('eventos.index') }}" class="botao">Ver eventos</a></p>

    <section>
        <h2>Próximos eventos</h2>
        <div class="grelha">
            @forelse ($proximos as $evento)
                <x-cartao-evento :evento="$evento" />
            @empty
                <x-alerta>Ainda não há eventos marcados.</x-alerta>
            @endforelse
        </div>
    </section>
@endsection