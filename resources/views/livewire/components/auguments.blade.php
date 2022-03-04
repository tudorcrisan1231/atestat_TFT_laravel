<div class="game_auguments">
    {{-- <button id="myButton">My button</button> --}}
    @for ($i = 0; $i < count($match['info']['participants'][$mainPlayerPOZ]['augments']); $i++)
        {{-- <p>{{ strtolower(substr($match['info']['participants'][$mainPlayerPOZ]['augments'][$i], 13)) }}</p> --}}
        <img
            src="https://raw.communitydragon.org/latest/game/assets/maps/particles/tft/item_icons/augments/hexcore/{{ strtolower(substr($match['info']['participants'][$mainPlayerPOZ]['augments'][$i], 13)) }}.tft_set6.png">
    @endfor
</div>
