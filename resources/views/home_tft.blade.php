@extends('layout.layout')
@section('content')
    <div class="layer_primary"></div>

    <div class="home">
        {{-- <img src="/images//home_img-removebg-preview.png" alt="poro_img" class="home_img"> --}}
        @guest
            <a class="login_btn" href="/login" style="color:#FFF; text-decoration:none;">LOGIN</a>
        @else
            @php
                $bookmarksDB = DB::table('bookmarks')->get();
                $bookmarks = [];
                for ($i = 0; $i < count($bookmarksDB); $i++) {
                    if ($bookmarksDB[$i]->id_user == Auth::user()->id) {
                        $bookmarks = json_decode($bookmarksDB[$i]->saves, true);
                    }
                }
                // dd();
            @endphp
            <div class="home_bookmarks">
                <div class="home_bookmarks_btn">
                    <div class="">{{ Auth::user()->name }}</div>
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                        <path fill="currentColor"
                            d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z" />
                    </svg>
                </div>
                <div class="home_bookmarks_dropdown hidden_bookmark">

                    <div class="home_bookmarks_dropdown_players">
                        <div class="home_bookmarks_dropdown_players_title">
                            <p>Bookmarks</p>
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M400 0H176a64.11 64.11 0 0 0-62 48h228a74 74 0 0 1 74 74v304.89l22 17.6a16 16 0 0 0 19.34.5a16.41 16.41 0 0 0 6.66-13.42V64a64 64 0 0 0-64-64Z" />
                                <path fill="currentColor"
                                    d="M320 80H112a64 64 0 0 0-64 64v351.62A16.36 16.36 0 0 0 54.6 509a16 16 0 0 0 19.71-.71L216 388.92l141.69 119.32a16 16 0 0 0 19.6.79a16.4 16.4 0 0 0 6.71-13.44V144a64 64 0 0 0-64-64Z" />
                            </svg>


                        </div>
                        @if (count($bookmarks) == 0)
                            <p style="text-align: center; padding:1rem 0;">No bookmarks yet...</p>
                        @else
                            @for ($i = 0; $i < count($bookmarks); $i++)
                                <a class="home_bookmarks_dropdown_players_player"
                                    href="/{{ $bookmarks[$i]['region'] }}/{{ $bookmarks[$i]['name'] }}">
                                    <p>#{{ $bookmarks[$i]['region'] }}</p>
                                    <p class="home_bookmarks_dropdown_players_player_name">{{ $bookmarks[$i]['name'] }}</p>
                                </a>
                            @endfor
                        @endif

                    </div>

                    <div class="home_bookmarks_dropdown_logout">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M6 30h12a2.002 2.002 0 0 0 2-2v-3h-2v3H6V4h12v3h2V4a2.002 2.002 0 0 0-2-2H6a2.002 2.002 0 0 0-2 2v24a2.002 2.002 0 0 0 2 2Z" />
                            <path fill="currentColor"
                                d="M20.586 20.586L24.172 17H10v-2h14.172l-3.586-3.586L22 10l6 6l-6 6l-1.414-1.414z" />
                        </svg>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        @endguest

        <p class="home_title">THE BEST TEAM STATS. MATCH HISTORY AT YOUR FINGERTIPS</p>


        <form class="home_form" action="/" method="POST"> {{-- datele din form le trimite POST la /  (adica home page ul) --}}
            @csrf
            <select class="home_form_region" name="region">
                <option disabled selected>Region...</option>
                <option value="eun1">EUNE</option>
                <option value="euw1">EUW</option>
                <option value="na1">NA</option>
                <option value="la1">LAN</option>
                <option value="la2">LAS</option>
                <option value="ru">RU</option>
                <option value="tr1">TR</option>
                <option value="kr">KR</option>
                <option value="oc1">OC</option>
                <option value="jp1">JP</option>
                <option value="br1">BR</option>
            </select>

            <input class="home_form_user" type="text" placeholder="Summoner's name..." name="summonerName">

            <button type="submit" class="home_form_btn">
                <svg class="svg-icon" viewBox="0 0 20 20">
                    <path
                        d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z">
                    </path>
                </svg>
            </button>
        </form>

        <div class="home_news">
            <div class="news_container">
                <h4 class="news_title">TFT: Teamfight Tactics news and useful links:</h4>
                <div class="news">
                    @for ($i = 0; $i < count($news); $i++)
                        <a class="news_article" href="{{ $news[$i]->link }}" target="_blank">
                            <img src="{{ $news[$i]->img }}" alt="patch_notes" class="news_img" />
                            <div class="news_article_details">
                                <h3 class="news_article_game">{{ $news[$i]->name }}</h3>
                                <p class="news_article_description">{{ $news[$i]->description }}</p>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>



    <!-- sa se mai poata schimba intre ele popup urile de login si register (clase diferite la close btn uri si la open) -->
@endsection
