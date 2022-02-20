<div wire:init="render_dataNotFound">


    @if($searched_data)
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

    @else

    <p>ok...</p>
    @endif


    <script>

        Livewire.emit('render_dataNotFound');

    </script>
</div>
