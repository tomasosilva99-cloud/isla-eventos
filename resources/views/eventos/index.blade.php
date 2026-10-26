<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de Eventos - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>Eventos {{ $tipo ? '(' . e($tipo) . ')' : '' }}</h1>

        <!-- E2. Ligações de filtro -->
        <nav>
            <ul>
                <li><a href="/eventos">Todos</a></li>
                <li><a href="/eventos?tipo=workshop">Workshops</a></li>
                <li><a href="/eventos?tipo=palestra">Palestras</a></li>
                <li><a href="/eventos?tipo=hackathon">Hackathons</a></li>
                <li><a href="/eventos/proximos">Próximos</a></li>
            </ul>
        </nav>

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
                @forelse ($eventos as $evento)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <!-- D3. Liga o título ao detalhe -->
                            <a href="/eventos/{{ $evento['id'] }}">{{ $evento['titulo'] }}</a>
                        </td>
                        <!-- C3. Data em formato português -->
                        <td>{{ date('d/m/Y', strtotime($evento['data'])) }}</td>
                        <td>
                            <!-- C4. Exibe Esgotado ou quantidade de vagas livres -->
                            @if ($evento['inscritos'] >= $evento['vagas'])
                                <strong>Esgotado</strong>
                            @else
                                {{ $evento['vagas'] - $evento['inscritos'] }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Não há eventos para mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p><a href="/">Voltar à página inicial</a></p>
    </main>
</body>
</html>