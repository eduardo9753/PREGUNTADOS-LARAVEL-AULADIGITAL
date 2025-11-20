<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Rankcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session()->has('usuario.id')) {
                return redirect()->route('login')->with('error', 'Inicia sesión para ver los datos');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user_id = session('usuario.id');
        $response = Http::get("https://veterinaria.banquea.pe/api/preguntados/game/rangos/{$user_id}");

        if ($response->successful()) {
            $data = $response->json();

            return view('rank.index', [
                'ranks' => $data['ranks'],
                'currentRank' => $data['currentRank'],
                'totalPoints' => $data['totalPoints']
            ]);
        }

        return view('rank.index', [
            'ranks' => [],
            'currentRank' => null,
            'totalPoints' => 0
        ]);
    }

    public function ranking()
    {
        $user_id = session('usuario.id');
        $response = Http::get("https://veterinaria.banquea.pe/api/preguntados/game/ranking/top10");

        if ($response->successful()) {
            $data = $response->json();

            return view('rank.ranking', [
                'ranking' => $data['ranking'],
            ]);
        }
    }

    //reglas del juego
    public function rule()
    {
        return view('rule.index');
    }
}
