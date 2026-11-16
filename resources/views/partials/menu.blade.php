<header class="topo">
    <div class="contentor">
        <strong><a href="{{ route('inicio') }}">{{ config('app.name') }}</a></strong>
        <nav>
            <a href="{{ route('inicio') }}"
               @if (request()->routeIs('inicio')) aria-current="page" @endif>Início</a>
            <a href="{{ route('eventos.index') }}"
               @if (request()->routeIs('eventos.*')) aria-current="page" @endif>Eventos</a>
        </nav>
    </div>
</header>