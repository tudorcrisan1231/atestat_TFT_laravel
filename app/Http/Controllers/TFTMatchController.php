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

        $news = DB::table('tft_news')->get();

        $test = 'test';
        // dd($response->object());
        return view('home', ['news' => $news]);
    }
}
