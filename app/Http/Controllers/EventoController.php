<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventoController extends Controller
{
    public function index(Request $request): View
    {
        $tipo = $request->query('tipo');

        $eventos = Evento::with('tipo')
            ->when($tipo, fn ($consulta) => $consulta->whereRelation('tipo', 'slug', $tipo))
            ->orderBy('data')
            ->get();

        $tipos = Tipo::orderBy('nome')->get();

        return view('eventos.index', [
            'eventos' => $eventos,
            'tipos' => $tipos,
            'tipo' => $tipo,
        ]);
    }

    public function show(Evento $evento): View
    {
        return view('eventos.show', [
            'evento' => $evento,
        ]);
    }
}