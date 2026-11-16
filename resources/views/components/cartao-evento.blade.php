@props(['evento'])

<article {{ $attributes->merge(['class' => 'cartao']) }}>
    <span class="etiqueta etiqueta-{{ $evento->tipo->slug }}">{{ $evento->tipo->nome }}</span>
    <h3>
        <a href="{{ route('eventos.show', $evento) }}">{{ $evento->titulo }}</a>
    </h3>
    <p>{{ $evento->data->format('d/m/Y') }} &bull; {{ $evento->local }}</p>
</article>