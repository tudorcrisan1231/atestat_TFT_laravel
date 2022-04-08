@extends('layout.layout')
@section('content')
    <div class="layer_primary"></div>

    <div class="home">
        {{-- <img src="/images//home_img-removebg-preview.png" alt="poro_img" class="home_img"> --}}
        <a class="login_btn" href="/login" style="color:#FFF; text-decoration:none;">LOGIN</a>

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
