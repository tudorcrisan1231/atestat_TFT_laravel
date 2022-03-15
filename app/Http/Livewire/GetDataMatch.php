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
    public $summonerNames = []; //numele celorlalti 7 jucatari din meci (se executa doar cand se da pe extend btn pt ca ar fi prea multe request uri)
    public $countTest = 0;
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
        // $this->getParticipantsNames($this->match);
        // dd($this->participantsNames);
    }

    public function orderPlacemnets($participants)
    {
        // $traits = $match['info']['participants'][$mainPlayerPOZ]['traits'];

        for ($i = 0; $i < count($participants); $i++) {
            for ($j = $i; $j < count($participants); $j++) {
                if ($participants[$j]['placement'] < $participants[$i]['placement']) {
                    $aux = $participants[$i];
                    $participants[$i] = $participants[$j];
                    $participants[$j] = $aux;
                }
            }
        }
        return $participants;
    }


    public function extendMatchData()
    {
        $this->isOpenAdvanced = !$this->isOpenAdvanced; //variabila de toggle la advanced stats

        $this->summonerNames = []; //cand se executa functia, se reseteaza vectorul

        $orderedPlayers = $this->orderPlacemnets($this->match['info']['participants']); //se ordoneaza crescator jucatorii dupa locul luat

        for ($i = 0; $i < count($orderedPlayers); $i++) {
            $api_key = $_ENV['API_KEY'];
            // https://{$this->region}.api.riotgames.com/tft/summoner/v1/summoners/by-name/{$summonerName}?api_key={$api_key}
            $response = Http::get("https://{$this->region}.api.riotgames.com/tft/summoner/v1/summoners/by-puuid/{$orderedPlayers[$i]['puuid']}?api_key={$api_key}");

            array_push($this->summonerNames, $response->json($key = null));
        }


        // dd($this->summonerNames);
        // dd('merge');
    }

    public function closeExtendMatchData()
    {
        $this->isOpenAdvanced = !$this->isOpenAdvanced; //variabila de toggle la advanced stats
    }
}
