<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GetDataMatch extends Component
{
    public $singleMatch;
    public $continent;
    public $region;
    public $puuid;
    public $companionJSON;
    public $queueJSON;
    public $augments_itemsJSON;
    public $match;  //datele in json despre meci
    public $matchResponseStatus; //verifica daca a fost facut request ul corect
    public $isOpenAdvanced = 0;
    public function render()
    {
        return view('livewire.get-data-match');
    }

    // public function getParticipantsNames($gameData)
    // {
    //     $api_key = $_ENV['API_KEY'];
    //     //get particiapnts names for each game
    //     for ($i = 0; $i < count($gameData['info']['participants']); $i++) {
    //         $data = Http::get("https://{$this->region}.api.riotgames.com/tft/summoner/v1/summoners/by-puuid/{$gameData['info']['participants'][$i]['puuid']}?api_key={$api_key}");
    //         array_push($this->participantsNames, $data->json($key = null)['name']);
    //     }

    //     // return $participantsNames;
    // }

    public function getDataSigleMatch()
    {
        $api_key = $_ENV['API_KEY'];
        $this->match = Http::get("https://{$this->continent}.api.riotgames.com/tft/match/v1/matches/{$this->singleMatch}?api_key={$api_key}");

        $this->matchResponseStatus = $this->match->status();

        $this->match = $this->match->json($key = null);

        $this->render();
        // $this->getParticipantsNames($this->match);
        // dd($this->participantsNames);
    }


    public function extendMatchData()
    {
        $this->isOpenAdvanced = !$this->isOpenAdvanced;
        // dd('merge');
    }
}
