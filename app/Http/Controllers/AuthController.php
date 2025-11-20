<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        // echo "study_id". $request->study_id;
        $study_id = $request->input('study_id');

        //llamada con cabecera
        $response = Http::withHeaders([
            'X-API-KEY' => 'login_preguntados'
        ])->post('https://preunicursos.com/api/preguntados/login', [
            'study_id' => $study_id
        ]);

        //dd($response->json());
        if ($response->successful()) {
            $data = $response->json();

            if ($data['status'] === 'success' && $data['avatar'] === 'sin datos') {
                session(['usuario' => $data['data']]);
                return redirect()->route('game.avatar.index');
            } else if ($data['status'] === 'success' && $data['avatar'] != 'sin datos') {
                session(['usuario' => $data['data']]);
                session(['avatar' => $data['avatar']]);
                return redirect()->route('game.home');
            } else {
                return back()->with('error', $data['message']);
            }
        } else {
            return back()->with('error', 'Error al conectar con el servidor banquea');
        }
        //return redirect()->route('game.home');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
