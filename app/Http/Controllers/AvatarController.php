<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvatarController extends Controller
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
        return view('avatar.index');
    }
}
