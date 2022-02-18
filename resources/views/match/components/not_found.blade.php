<div class="match_error">
    <p> Can't find <span class="match_error_name">{{$summonerName}} #{{$region}}</span>. Please check spelling.</p>
    <a href="/" class="match_error_back">Back home</a>
    <p>OR</p>

    @for($i=0; $i<count($searched_data); $i++)
        <div class="match_error_player">
            @if(count($searched_data[$i])==4)
                <p>{{$searched_data[$i][1]}}:</p>
                <img src="http://ddragon.leagueoflegends.com/cdn/12.4.1/img/profileicon/{{$searched_data[$i][3]}}.png">
                <a href="/{{$searched_data[$i][0]}}/{{$summonerName}}">{{$summonerName}}</a>

                @else
                <p>{{$searched_data[$i][1]}}:</p>
                <p>-</p>
            @endif
        </div>

    @endfor
    
    {{-- @php echo App\Http\Controllers\TFTMatchController::test(1);  @endphp --}}
    
</div>