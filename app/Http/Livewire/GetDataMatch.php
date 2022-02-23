<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GetDataMatch extends Component
{
    public $singleMatch;
    public $continent;
    public $match;  //datele in json despre meci
    public $matchResponseStatus; //verifica daca a fost facut request ul corect
    public function render()
    {
        return view('livewire.get-data-match');
    }

    public function getDataSigleMatch()
    {
        $api_key = $_ENV['API_KEY'];
        $this->match = Http::get("https://{$this->continent}.api.riotgames.com/tft/match/v1/matches/{$this->singleMatch}?api_key={$api_key}");

        $this->matchResponseStatus = $this->match->status();

        $this->match = $this->match->json($key = null);

        $this->render();
    }
}
