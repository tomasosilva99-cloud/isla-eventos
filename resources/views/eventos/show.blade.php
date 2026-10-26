<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $evento['titulo'] }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>{{ $evento['titulo'] }}</h1>
        <p><strong>Tipo:</strong> {{ ucfirst($evento['tipo']) }}</p>
        <p><strong>Data:</strong> {{ date('d/m/Y', strtotime($evento['data'])) }}</p>
        <p><strong>Local:</strong> {{ $evento['local'] }}</p>
        <p><strong>Inscritos:</strong> {{ $evento['inscritos'] }} de {{ $evento['vagas'] }}</p>

        <p><a href="/eventos" role="button" class="secondary">Voltar aos eventos</a></p>
    </main>
</body>
</html>