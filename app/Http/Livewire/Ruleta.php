<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Ruleta extends Component
{

    public $categories = [];
    public $selectedCategory = null;

    public function mount()
    {
        // Traer categorías desde la API
        $response = Http::get('https://veterinaria.banquea.pe/api/preguntados/questions/categories');

        if ($response->ok()) {
            $this->categories = $response->json();
        }
    }

    public function spinWheel()
    {
        // Elegir una categoría aleatoria
        if (!empty($this->categories)) {
            $this->selectedCategory = $this->categories[array_rand($this->categories)];

            // Redirigir al otro componente livewire de pregunts para contestar
            return redirect()->route('game.index', ['category_id' => $this->selectedCategory['id'], '']);
        }
    }

    public function render()
    {
        return view('livewire.ruleta');
    }
}
