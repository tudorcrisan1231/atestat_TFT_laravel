<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TFTMatchController extends Controller
{
    public function homePageData()
    {
        $response = Http::get('https://eun1.api.riotgames.com/tft/summoner/v1/summoners/by-name/Sm03KeR?api_key=RGAPI-0126f4f3-72ee-49fd-b2d7-180c812d3bec');

        $news = DB::table('tft_news')->get();  //trimit in home lista cu news din DB

        $test = 'test';
        // dd($response->object());
        return view('home', ['news' => $news]);
    }

    public function matchData($region, $summonerName)
    {
        $api_key = $_ENV['API_KEY'];

        $profile_data = Http::get("https://{$region}.api.riotgames.com/tft/summoner/v1/summoners/by-name/{$summonerName}?api_key={$api_key}");





        if ($profile_data->status() == 200) {
            $rank = $this->getRank($profile_data->object()->id, $region, $api_key);

            return view('match.match', ['region' => $region, 'summonerName' => $summonerName, 'profile_data' => $profile_data->object(), 'ranks' => $rank]);
        } else {

            $regions = DB::table('regions')->get();
            // dd($regions[0]->region);

            $account_found = array();

            for ($i = 0; $i < count($regions); $i++) {
                $response = Http::get("https://{$regions[$i]->region}.api.riotgames.com/tft/summoner/v1/summoners/by-name/{$summonerName}?api_key={$api_key}");

                if ($response->status() == 200) {
                    array_push($account_found, [$regions[$i]->region, $regions[$i]->region_name, 'yes', $response->object()->profileIconId]);
                } else {
                    array_push($account_found, [$regions[$i]->region, $regions[$i]->region_name, 'no']);
                }
            }


            return view('match.match', ['region' => $region, 'summonerName' => $summonerName, 'profile_data' => 'no', 'searched_data' => $account_found]);
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


    public function getDataFormHomePage()
    {

        $region =  request('region');  //iau datele puse in form ul din home.blade.php
        $summonerName = request('summonerName');

        return redirect()->route('match', ['region' => $region, 'summonerName' => $summonerName]);  //le dau redirect pe route ul '/$region/$summonerName' dupa intra in functia matchData care se va ocupa mai departe cu datele
    }
}
