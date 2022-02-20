<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class GetDataTFT extends Component
{
    public $summonerName;
    public $searched_data = [];
    public function render()
    {

        return view('livewire.get-data-t-f-t');
    }

    public function render_dataNotFound()
    {
        $regions = DB::table('regions')->get();
        $api_key = $_ENV['API_KEY'];
        $account_found = array();

        for ($i = 0; $i < count($regions); $i++) {
            $response = Http::get("https://{$regions[$i]->region}.api.riotgames.com/tft/summoner/v1/summoners/by-name/{$this->summonerName}?api_key={$api_key}");

            if ($response->status() == 200) {
                array_push($account_found, [$regions[$i]->region, $regions[$i]->region_name, 'yes', $response->object()->profileIconId]);
            } else {
                array_push($account_found, [$regions[$i]->region, $regions[$i]->region_name, 'no']);
            }
        }
        $this->searched_data = $account_found;
        // dd('salut');
        $this->render();
    }
}
