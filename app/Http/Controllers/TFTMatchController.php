<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TFTMatchController extends Controller
{
    public function homePageData()
    {
        // $response = Http::get('https://eun1.api.riotgames.com/tft/summoner/v1/summoners/by-name/Sm03KeR?api_key=RGAPI-0126f4f3-72ee-49fd-b2d7-180c812d3bec');

        $news = DB::table('tft_news')->get();  //trimit in home lista cu news din DB

        $test = 'test';
        // dd($response->object());
        return view('home', ['news' => $news]);
    }
    public function getRegionContinent($region)
    {
        if (
            $region == "eun1" ||
            $region == "tr" ||
            $region == "euw1" ||
            $region == "ru"
        ) {
            return "europe";
        } else if (
            $region == "na1" ||
            $region == "br1" ||
            $region == "la1" ||
            $region == "la2" ||
            $region == "oc1"
        ) {
            return "americas";
        } else {
            return "asia";
        }
    }

    public function matchData($region, $summonerName)
    {
        $api_key = $_ENV['API_KEY'];

        $profile_data = Http::get("https://{$region}.api.riotgames.com/tft/summoner/v1/summoners/by-name/{$summonerName}?api_key={$api_key}");


        // dd($profile_data->object());


        if ($profile_data->status() == 200) {
            $rank = $this->getRank($profile_data->object()->id, $region, $api_key);  //rank urile 
            $gamesId_list = $this->getMatchHistory($profile_data->object()->puuid, $region, $api_key); //lista cu match id uri (10)
            $companion_json = Http::get("https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/v1/companions.json");
            $queues_json = Http::get("https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/v1/queues.json");
            $queue_json = [];
            array_push($queue_json, $queues_json->json($key = null));

            $augments_itemsJSON = Http::get("https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/v1/tftitems.json"); //json cu datele despre iteme si augmnets
            // dd($augments_itemsJSON->object());

            // dd($queue_json);

            return view('match.match', ['region' => $region, 'continent' => $this->getRegionContinent($region), 'summonerName' => $summonerName, 'profile_data' => $profile_data->object(), 'ranks' => $rank, 'games_list' => $gamesId_list, 'companion_json' => $companion_json->object(), 'queues_json' => $queue_json, 'augments_itemsJSON' => $augments_itemsJSON->object()]);
        } else {

            return view('match.match', ['region' => $region, 'summonerName' => $summonerName, 'profile_data' => 'no']);
        }
    }

    public function getRank($summonerID, $region, $api_key)
    {
        $response = Http::get("https://{$region}.api.riotgames.com/tft/league/v1/entries/by-summoner/{$summonerID}?api_key={$api_key}");

        // dd($response->object());

        $ranks_hyperRoll = 'unranked';
        $ranks_ranked = 'unranked';

        $response = $response->object();

        if (count($response) == 0) {
            $ranks_ranked = 'unranked';
            $ranks_hyperRoll = 'unranked';
        } else {
            for ($i = 0; $i < count($response); $i++) {
                if ($response[$i]->queueType == 'RANKED_TFT_TURBO') {
                    $ranks_hyperRoll = $response[$i];
                }
            }
            for ($i = 0; $i < count($response); $i++) {
                if ($response[$i]->queueType == 'RANKED_TFT') {
                    $ranks_ranked = $response[$i];
                }
            }
        }
        // dd([$ranks_ranked, $ranks_hyperRoll]);
        return [$ranks_ranked, $ranks_hyperRoll];
    }

    public function getMatchHistory($puuid, $region, $api_key)
    {
        $gamesId_list = Http::get("https://{$this->getRegionContinent($region)}.api.riotgames.com/tft/match/v1/matches/by-puuid/{$puuid}/ids?count=10&api_key={$api_key}");
        // dd($gamesId_list->object());
        return $gamesId_list->object();
    }


    public function getDataFormHomePage()
    {

        $region =  request('region');  //iau datele puse in form ul din home.blade.php
        $summonerName = request('summonerName');

        return redirect()->route('match', ['region' => $region, 'summonerName' => $summonerName]);  //le dau redirect pe route ul '/$region/$summonerName' dupa intra in functia matchData care se va ocupa mai departe cu datele
    }
}
