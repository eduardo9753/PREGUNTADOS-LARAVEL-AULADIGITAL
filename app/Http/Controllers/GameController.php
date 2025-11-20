<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session()->has('usuario.id')) {
                return redirect()->route('login')->with('error', 'Inicia sesión para ver los datos');
            }
            return $next($request);
        });
    }


    //PAGINA PRINCIPAL DESPUES DE LOGEARSE
    public function home()
    {
        $user = session('usuario');
        $user_id = session('usuario.id');
        $response = Http::get("https://veterinaria.banquea.pe/api/preguntados/game/avatars/{$user_id}");

        if ($response->successful()) {
            $avatar = $response->json();
            //dd($avatar);
            return view('game.home', [
                'user' => $user,
                'avatar' => $avatar
            ]);
        } else {
            return redirect()->route('game.avatar.index');
        }
        //dd(session('usuario.id'));
        //dd($user);
    }

    //RELETA DE CATEGORIAS Y TE DIRIGE AL COMPONENTE LIVEWIRE DE PREGUNTAS PARA CONTESTAR
    public function ruleta()
    {
        return view('game.ruleta');
    }

    //COMPONENTE DE PREGUNTAS CON LA CATEGORIA SELECCIONADA EN AL RULETA
    public function index($category_id)
    {
        return view('game.index', [
            'category_id' => $category_id
        ]);
    }

    //PARA GUARDAR EL SCORE DEL JUEGO SINLE
    public function scoreSingle($correct)
    {
        $user_id = session('usuario.id');

        $response = Http::get("https://veterinaria.banquea.pe/api/preguntados/score/single/$user_id/$correct");

        if ($response->successful()) {
            $data = $response->json();
            if ($data['success'] == 'score creado') {
                return redirect()->route('game.home');
            } else {
                return redirect()->route('game.home');
            }
        } else {
            return redirect()->route('game.home');
        }
    }

    //COMPONENTE DE MULTIGUJADOR
    public function manager($user_id)
    {
        //dd($user_id);
        //api de categorias+
        $response = Http::get('https://veterinaria.banquea.pe/api/preguntados/questions/categories');
        $categories = $response->successful() ? $response->json() : [];
        //dd($categories);
        return view('game.manager', [
            'user_id' => $user_id,
            'categories' => $categories
        ]);
    }

    //para crear el juego
    public function create(Request $request)
    {
        $response = Http::post("https://veterinaria.banquea.pe/api/preguntados/game/create", [
            'creator_id' => session('usuario.id'),
            'category_id' => $request->category_id,
            'category_type' => 'question',
            'max_players' => $request->max_players,
            'total_questions' => 10,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            //dd($data);
            return redirect()->route('game.wait', ['game_id' => $data['game']['id']])
                ->with('success', 'Partida creada con éxito. Comparte el código con tus amigos.');
        }
        return back()->with('error', 'No se puedo crear la partida');
    }

    //sala de espera de los jugadores
    public function wait($game_id)
    {
        $response = Http::get("https://veterinaria.banquea.pe/api/preguntados/game/get/{$game_id}");
        if ($response->successful()) {
            $game = $response->json();
            //dd($game);
            return view('game.wait', [
                'game' => $game
            ]);
        } else {
            return back()->with('error', 'Datos no encontrados del jeugo ');
        }
    }

    //vista para jugar con otros jugadores
    public function play($game_id)
    {
        //dd($game_id);
        $response = Http::get("https://veterinaria.banquea.pe/api/preguntados/game/get/{$game_id}");
        $user_id = session('usuario.id');
        $personaje = Http::get("https://veterinaria.banquea.pe/api/preguntados/game/avatars/{$user_id}");
        if ($personaje->successful()) {
            $avatar = $response->json();
        } else {
            $avatar = [];
        }
        if ($response->successful()) {
            $game = $response->json();
            $currentUserId = session('usuario.id');
            $currentPlayer = collect($game['players'])->firstWhere('user_id', $currentUserId);
            //dd($game);

            return view('game.play', [
                'game' => $game,
                'currentPlayer' => $currentPlayer,
                'avatar' => $avatar
            ]);
        } else {
            return redirect()->route('game.home')->with('error', 'No se encontró partida para el juego actual');
        }
    }
}
