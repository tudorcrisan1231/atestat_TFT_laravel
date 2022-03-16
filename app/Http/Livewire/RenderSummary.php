<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class RenderSummary extends Component
{
    public $gameList;
    public $continent;
    public $matchData = [];

    public function render()
    {
        return view('livewire.render-summary');
    }

    public function getDataSummary()
    {
        $api_key = $_ENV['API_KEY'];
        for ($i = 0; $i < count($this->gameList); $i++) {
            $response = Http::get("https://{$this->continent}.api.riotgames.com/tft/match/v1/matches/{$this->gameList[$i]}?api_key={$api_key}");

            array_push($this->matchData, $response->status());
        }

        $this->render();
    }
}
