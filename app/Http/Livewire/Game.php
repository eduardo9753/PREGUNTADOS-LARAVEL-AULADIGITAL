<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Game extends Component
{
    public $question;
    public $answers = [];
    public $selectedAnswer = null;
    public $isChecked = false;
    public $isCorrect = false;

    public $category_id = 4;
    public $currentQuestion = 1;
    public $totalQuestions = 10;
    public $progress = 0;

    public $correctAnswers = 0;
    public $finished = false;

    public $timeLeft = 60;

    protected $listeners = ['tick' => 'decreaseTime', 'autoNext' => 'nextQuestion'];

    public function mount($category_id)
    {
        $this->category_id = $category_id;
        $this->loadQuestion();
        $this->updateProgress();
    }

    public function reload()
    {
        $this->finished = false;
        $this->currentQuestion = 1;
        $this->correctAnswers = 0;
        $this->timeLeft = 60;
        $this->loadQuestion();
        $this->updateProgress();
    }

    public function loadQuestion()
    {
        try {
            $response = Http::get("https://enam.pe/api/preguntados/questions/{$this->category_id}/{$this->totalQuestions}");

            if ($response->successful()) {
                $data = $response->json();

                // validamos que haya preguntas
                if (!empty($data)) {
                    $this->question = $data[0];
                    $this->answers = $this->question['answers'] ?? [];
                    $this->timeLeft = 60;
                } else {
                    $this->question = null;
                    $this->answers = [];
                    $this->finished = true;
                }
            } else {
                $this->question = null;
                $this->answers = [];
            }
        } catch (\Exception $e) {
            $this->question = null;
            $this->answers = [];
        }
    }

    public function selectAnswer($answerId)
    {
        if (!$this->isChecked) {
            $this->selectedAnswer = $answerId;
        }
    }

    public function checkAnswer()
    {
        if (!$this->selectedAnswer) return;

        $correct = collect($this->answers)->firstWhere('correct', 1);
        $this->isCorrect = $this->selectedAnswer == ($correct['id'] ?? null);
        $this->isChecked = true;

        if ($this->isCorrect) {
            $this->correctAnswers++;
        }
    }

    public function decreaseTime()
    {
        if ($this->finished || $this->isChecked) return;

        $this->timeLeft--;

        if ($this->timeLeft <= 0) {
            $this->isChecked = true;
            $this->isCorrect = false;
            $this->emit('autoNext');
        }
    }

    public function nextQuestion()
    {
        if ($this->currentQuestion < $this->totalQuestions) {
            $this->currentQuestion++;
            $this->reset(['selectedAnswer', 'isChecked', 'isCorrect']);
            $this->loadQuestion();
            $this->updateProgress();
        } else {
            $this->progress = 100;
            $this->finished = true;
        }
    }

    public function updateProgress()
    {
        $this->progress = ($this->currentQuestion / $this->totalQuestions) * 100;
    }

    public function render()
    {
        return view('livewire.game');
    }
}
