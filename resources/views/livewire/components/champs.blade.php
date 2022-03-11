<div class="game_champs">

    @php
        $items = [];
        for ($i = 0; $i < count($match['info']['participants'][$mainPlayerPOZ]['units']); $i++) {
            $aux = [];
            for ($j = 0; $j < count($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['items']); $j++) {
                for ($h = 0; $h < count($augments_itemsJSON); $h++) {
                    if ($augments_itemsJSON[$h]['id'] == $match['info']['participants'][$mainPlayerPOZ]['units'][$i]['items'][$j]) {
                        // echo $augments_itemsJSON[$h]['name'];
                        array_push($aux, [$augments_itemsJSON[$h]['name'], $augments_itemsJSON[$h]['loadoutsIcon']]);
                    }
                }
            }
            if (count($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['items']) == 0) {
                array_push($items, []);
            } else {
                array_push($items, $aux);
            }
        }
        
        // dd($items);
        
        function starColor($tier)
        {
            if ($tier == 3) {
                return 'gold';
            } elseif ($tier == 2) {
                return 'silver';
            } else {
                return '#8B4513';
            }
        }
        
    @endphp

    @for ($i = 0; $i < count($match['info']['participants'][$mainPlayerPOZ]['units']); $i++)
        <div class="game_champs_champ">
            <div class="game_champs_level">
                @for ($j = 0; $j < $match['info']['participants'][$mainPlayerPOZ]['units'][$i]['tier']; $j++)
                    <svg class="game_champs_level_svg" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                        width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                        <path
                            fill="{{ starColor($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['tier']) }}"
                            d="m16 2l-4.55 9.22l-10.17 1.47l7.36 7.18L6.9 30l9.1-4.78L25.1 30l-1.74-10.13l7.36-7.17l-10.17-1.48Z" />
                    </svg>
                @endfor

            </div>

            @if (substr($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id'], 5) == '_Vi')
                <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/tft6_vi/hud/tft6_vi.tft_set6_stage2.png"
                    alt="vi" class="game_champs_img tippy_tooltip"
                    data-tippy-content="{{ substr($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id'], 6) }}"
                    onmouseover="startTippy()">

                {{-- la campionul VI, apare o eroare in documnetatie si trebuie pus manual --}}
            @else
                <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}/hud/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}.tft_set6_stage2.png"
                    alt="" class="game_champs_img tippy_tooltip"
                    onerror="this.src='https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}/hud/{{ strtolower($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id']) }}_square.tft_set6.png';"
                    data-tippy-content="{{ substr($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['character_id'], 5) }}"
                    onmouseover="startTippy()">
                {{-- sunt 2 tipuri de png uri cu campionii din tft, una cu campionii simpli si una cu campionii din stage2, pun functia onerror, care daca nu mi randeaza prima img, mi o pune a pe a doua cu stage2 --}}
            @endif

            {{--  --}}

            <div class="game_champs_items">
                @for ($j = 0; $j < count($items[$i]); $j++)
                    @if (count($items[$i][$j]) != 0)
                        <img class="game_champs_items_img tippy_tooltip"
                            src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/maps/particles/tft/{{ strtolower(substr($items[$i][$j][1], 48)) }}"
                            alt="items icon tft" data-tippy-content="{{ $items[$i][$j][0] }}"
                            onmouseover="startTippy()">
                    @endif
                @endfor
            </div>
        </div>
    @endfor

</div>
{{-- onerror="this.onerror=null;this.src='https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/maps/particles/tft/tft_item_unknown.png'" --}}
