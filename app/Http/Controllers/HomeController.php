<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Nette\Utils\Json;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/');
    }

    public function deleteBookmark()
    {
        $region =  request('region');  //
        $summonerName = request('name');
        $user_id =  request('user_id');

        $bookmarks = DB::table('bookmarks')->get();

        $dbPoz;
        $savesArray;

        for ($i = 0; $i < count($bookmarks); $i++) {
            if ($bookmarks[$i]->id_user == $user_id) {
                $dbPoz = $i;
                $savesArray = $bookmarks[$i]->saves;
            }
        }

        $savesArrayJSON = json_decode($savesArray, true);

        for ($i = 0; $i < count($savesArrayJSON); $i++) {
            if ($savesArrayJSON[$i]['region'] == $region && $savesArrayJSON[$i]['name'] == $summonerName) {
                array_splice($savesArrayJSON, $i, 1);
            }
        }

        DB::update('update bookmarks set  saves = ? where id_user=?', [json_encode($savesArrayJSON), $user_id]);

        // dd($savesArrayJSON);
        return redirect(url('/' . $region . '/' . $summonerName))->with('status', 'Bookmark deleted!');
    }
    public function addBookmark()
    {
        $region =  request('region');  //
        $summonerName = request('name');
        $user_id =  request('user_id');

        $bookmarks = DB::table('bookmarks')->get();

        $exist = 0; //variabila care verifica daca exista deja user ul in tabelul de bookmars (daca a mai utilizat functia de bookmarks)

        $bookmarksArray;

        for ($i = 0; $i < count($bookmarks); $i++) {
            if ($bookmarks[$i]->id_user == $user_id) {
                $exist = 1;
                $bookmarksArray = $bookmarks[$i]->saves;
            }
        }

        if ($exist == 0) {
            $savesArray = array("region" => $region, "name" => $summonerName);
            // dd($savesArray);
            DB::insert('insert into bookmarks (id_user, saves) values (?, ?)', [$user_id, json_encode([$savesArray])]);
        } else {

            // dd($jsonArray);
            $decodedBookmarks = json_decode($bookmarksArray);
            array_push($decodedBookmarks, array("region" => $region, "name" => $summonerName));
            DB::update('update bookmarks set  saves = ? where id_user=?', [json_encode($decodedBookmarks), $user_id]);
        }
        // return redirect(url('/' . $region . '/' . $summonerName));
        return redirect(url('/' . $region . '/' . $summonerName))->with('status', 'Bookmark added!');
        // dd($exist);

        // dd($region, $summonerName, $user_id);
    }
}
