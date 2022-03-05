<div class="game_champs">


    @for ($i = 0; $i < count($match['info']['participants'][$mainPlayerPOZ]['units']); $i++)
        <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}/hud/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}_square.tft_set6.png"
            alt="" class="game_champs_img tippy_tooltip"
            onerror="this.onerror=null;this.src='https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}/hud/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}.tft_set6_stage2.png';"
            data-tippy-content="{{ substr($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id'], 5) }}"
            onmouseover="startTippy()">

        {{-- sunt 2 tipuri de png uri cu campionii din tft, una cu campionii simpli si una cu campionii din stage2, pun functia onerror, care daca nu mi randeaza prima img, mi o pune a pe a doua cu stage2 --}}
    @endfor

</div>
