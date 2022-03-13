<div class="advanced">
    @php
        //ordonez crescator
        function orderPlacemnets($participants)
        {
            // $traits = $match['info']['participants'][$mainPlayerPOZ]['traits'];
        
            for ($i = 0; $i < count($participants); $i++) {
                for ($j = $i; $j < count($participants); $j++) {
                    if ($participants[$j]['placement'] < $participants[$i]['placement']) {
                        $aux = $participants[$i];
                        $participants[$i] = $participants[$j];
                        $participants[$j] = $aux;
                    }
                }
            }
            return $participants;
        }
        
        $orderedSummoners = orderPlacemnets($match['info']['participants']); //vector cu participantii ordonati crescator dupa locul obtinut
        
        $companionsIMG = []; //vector cu toate skin urile
        for ($j = 0; $j < count($orderedSummoners); $j++) {
            for ($i = 0; $i < count($companionJSON); $i++) {
                if ($orderedSummoners[$j]['companion']['content_ID'] == $companionJSON[$i]['contentId']) {
                    array_push($companionsIMG, substr($companionJSON[$i]['loadoutsIcon'], 49));
                }
            }
        }
        
        $augmentsSummoners = []; //vector cu toate augmentele jucatorilor
        for ($h = 0; $h < count($orderedSummoners); $h++) {
            $help = [];
            for ($i = 0; $i < count($augments_itemsJSON); $i++) {
                //iau datele de la api ul oficial si verific in json ul cu iteme si augments daca exista, salvand in $augments id ul imaginii si numele fiecarui augument din meci;
                for ($j = 0; $j < count($orderedSummoners[$h]['augments']); $j++) {
                    if ($orderedSummoners[$h]['augments'][$j] == $augments_itemsJSON[$i]['nameId']) {
                        array_push($help, [strtolower($augments_itemsJSON[$i]['loadoutsIcon']), $augments_itemsJSON[$i]['name']]); //$augments[0][a sau b]  a  = id ul img ului, b = numele
                    }
                }
            }
            array_push($augmentsSummoners, $help);
        }
        
        $traitsSummoners = []; //vector cu toate trait urile jucatorilor
        for ($i = 0; $i < count($orderedSummoners); $i++) {
            $traitsSingleSummoner = orderTierTraits($orderedSummoners[$i]['traits']);
        
            array_push($traitsSummoners, $traitsSingleSummoner);
        }
        
        $itemsSummoners = []; //vector cu toti campionii jucatorilor + iteme + level
        
        for ($h = 0; $h < count($orderedSummoners); $h++) {
            $itemsSingleSummoner = [];
            for ($i = 0; $i < count($orderedSummoners[$h]['units']); $i++) {
                $aux = [];
                for ($j = 0; $j < count($orderedSummoners[$h]['units'][$i]['items']); $j++) {
                    for ($g = 0; $g < count($augments_itemsJSON); $g++) {
                        if ($augments_itemsJSON[$g]['id'] == $orderedSummoners[$h]['units'][$i]['items'][$j]) {
                            // echo $augments_itemsJSON[$h]['name'];
                            array_push($aux, [$augments_itemsJSON[$g]['name'], $augments_itemsJSON[$g]['loadoutsIcon']]);
                        }
                    }
                }
                if (count($orderedSummoners[$h]['units'][$i]['items']) == 0) {
                    array_push($itemsSingleSummoner, []);
                } else {
                    array_push($itemsSingleSummoner, $aux);
                }
            }
            array_push($itemsSummoners, $itemsSingleSummoner);
        }
        
        $boardValueSummoners = [];
        
        for ($h = 0; $h < count($orderedSummoners); $h++) {
            $singleBoard_value = 0;
            for ($i = 0; $i < count($orderedSummoners[$h]['units']); $i++) {
                if ($orderedSummoners[$h]['units'][$i]['tier'] == 1) {
                    $singleBoard_value += ($orderedSummoners[$h]['units'][$i]['rarity'] + 1) * 1;
                } elseif ($orderedSummoners[$h]['units'][$i]['tier'] == 2) {
                    $singleBoard_value += ($orderedSummoners[$h]['units'][$i]['rarity'] + 1) * 3;
                } elseif ($orderedSummoners[$h]['units'][$i]['tier'] == 3) {
                    $singleBoard_value += ($orderedSummoners[$h]['units'][$i]['rarity'] + 1) * 9;
                }
            }
            array_push($boardValueSummoners, $singleBoard_value);
        }
        
        // dd($boardValueSummoners);
        
    @endphp


    <div class="advanced_desktop">

        <table style="width: 100%;" class="advanced_table">
            <tr style="background-color: rgba(0, 0, 0, 0.1);">
                <th>Rank</th>
                <th>Summoner</th>
                <th>Traits</th>
                <th>Augmnets</th>
                <th>Units</th>
                {{-- <th>Damage <br> done</th>
                <th>Alive</th>
                <th>Board <br> value</th>
                <th>Left Gold</th> --}}
                <th>Stats</th>
            </tr>
            @for ($i = 0; $i < count($summonerNames); $i++)
                <tr
                    class=" {{ $summonerNames[$i]['puuid'] == $match['info']['participants'][$mainPlayerPOZ]['puuid']? 'advanced_active': '' }} ">
                    <td>#{{ $i + 1 }}</td>
                    <td class="advanced_table_profile_td">
                        <div class="advanced_table_profile">
                            <img class="game_companionIMG"
                                src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/loadouts/companions/{{ strtolower($companionsIMG[$i]) }}"
                                alt="companion img">
                            <p class="advanced_table_profile_level tippy_tooltip" data-tippy-content="Level"
                                onmouseover="startTippy()"> {{ $orderedSummoners[$i]['level'] }}</p>
                            <a target="_blank" href="/{{ $region }}/{{ $summonerNames[$i]['name'] }}">
                                {{ $summonerNames[$i]['name'] }}
                            </a>
                        </div>
                    </td>
                    <td class="advanced_table_traits_td">
                        <div class="advanced_table_traits">
                            @for ($j = 0; $j < count($traitsSummoners[$i]); $j++)
                                @if ($traitsSummoners[$i][$j]['tier_current'] > 0)
                                    <div class="game_traits_trait">


                                        <div class="game_traits_trait_img">
                                            {{-- unde am if uri sunt exceptii, din documentatia ddragon si din requesturile de pe api --}}


                                            @if ($traitsSummoners[$i][$j]['name'] == 'Set6_Hextech')
                                                <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_hextech.png"
                                                    alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                                                    style="background-image: url('/images/tier{{ $traitsSummoners[$i][$j]['style'] }}.png'); "
                                                    data-tippy-content="{{ $traitsSummoners[$i][$j]['num_units'] }} Hextech"
                                                    onmouseover="startTippy()">
                                            @elseif($traitsSummoners[$i][$j]['name'] == 'Set6_Bodyguard')
                                                <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_6_hero.png"
                                                    alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                                                    style="background-image: url('/images/tier{{ $traitsSummoners[$i][$j]['style'] }}.png'); "
                                                    data-tippy-content="{{ $traitsSummoners[$i][$j]['num_units'] }} Bodyguard"
                                                    onmouseover="startTippy()">
                                            @elseif(strtolower(substr($traitsSummoners[$i][$j]['name'], 3)) == '6_mutant')
                                                <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_6_experimental.png"
                                                    alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                                                    style="background-image: url('/images/tier{{ $traitsSummoners[$i][$j]['style'] }}.png'); "
                                                    data-tippy-content="{{ $traitsSummoners[$i][$j]['num_units'] }} Mutant"
                                                    onmouseover="startTippy()">
                                            @else
                                                <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_{{ strtolower(substr($traitsSummoners[$i][$j]['name'], 3)) }}.png"
                                                    alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                                                    style="background-image: url('/images/tier{{ $traitsSummoners[$i][$j]['style'] }}.png'); "
                                                    data-tippy-content="{{ $traitsSummoners[$i][$j]['num_units'] }} {{ ucfirst(strtolower(substr($traitsSummoners[$i][$j]['name'], 5))) }}"
                                                    onmouseover="startTippy()">
                                            @endif


                                        </div>


                                    </div>
                                @endif
                            @endfor
                        </div>

                    </td>

                    <td>
                        <div class="advanced_table_augments">
                            @for ($j = 0; $j < count($augmentsSummoners[$i]); $j++)
                                <img class="game_auguments_img tippy_tooltip"
                                    src="https://raw.communitydragon.org/latest/game/assets/maps/{{ substr($augmentsSummoners[$i][$j][0], 34) }}"
                                    data-tippy-content="{{ $augmentsSummoners[$i][$j][1] }}"
                                    onmouseover="startTippy()">
                            @endfor
                        </div>

                    </td>

                    <td>
                        <div class="advanced_table_units">
                            @for ($j = 0; $j < count($orderedSummoners[$i]['units']); $j++)

                                <div class="advanced_table_units_champ">
                                    <div class="game_champs_level">
                                        @for ($h = 0; $h < $orderedSummoners[$i]['units'][$j]['tier']; $h++)
                                            <svg class="game_champs_level_svg" xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true" role="img" width="1em" height="1em"
                                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                                                <path
                                                    fill="{{ starColor($orderedSummoners[$i]['units'][$j]['tier']) }}"
                                                    d="m16 2l-4.55 9.22l-10.17 1.47l7.36 7.18L6.9 30l9.1-4.78L25.1 30l-1.74-10.13l7.36-7.17l-10.17-1.48Z" />
                                            </svg>
                                        @endfor

                                    </div>

                                    @if (substr($orderedSummoners[$i]['units'][$j]['character_id'], 5) == '_Vi')
                                        <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/tft6_vi/hud/tft6_vi.tft_set6_stage2.png"
                                            alt="vi" class="game_champs_img tippy_tooltip"
                                            data-tippy-content="{{ substr($orderedSummoners[$i]['units'][$j]['character_id'], 6) }}"
                                            onmouseover="startTippy()">

                                        {{-- la campionul VI, apare o eroare in documnetatie si trebuie pus manual --}}
                                    @else
                                        <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($orderedSummoners[$i]['units'][$j]['character_id']) }}/hud/{{ strtolower($orderedSummoners[$i]['units'][$j]['character_id']) }}.tft_set6_stage2.png"
                                            alt="" class="game_champs_img tippy_tooltip"
                                            onerror="this.src='https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($orderedSummoners[$i]['units'][$j]['character_id']) }}/hud/{{ strtolower($orderedSummoners[$i]['units'][$j]['character_id']) }}_square.tft_set6.png';"
                                            data-tippy-content="{{ substr($orderedSummoners[$i]['units'][$j]['character_id'], 5) }}"
                                            onmouseover="startTippy()">
                                        {{-- sunt 2 tipuri de png uri cu campionii din tft, una cu campionii simpli si una cu campionii din stage2, pun functia onerror, care daca nu mi randeaza prima img, mi o pune a pe a doua cu stage2 --}}
                                    @endif

                                    <div class="game_champs_items">
                                        @for ($h = 0; $h < count($itemsSummoners[$i][$j]); $h++)
                                            @if (count($itemsSummoners[$i][$j][$h]) != 0)
                                                <img class="game_champs_items_img tippy_tooltip"
                                                    src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/maps/particles/tft/{{ strtolower(substr($itemsSummoners[$i][$j][$h][1], 48)) }}"
                                                    alt="items icon tft"
                                                    data-tippy-content="{{ $itemsSummoners[$i][$j][$h][0] }}"
                                                    onmouseover="startTippy()">
                                            @endif
                                        @endfor
                                    </div>
                                </div>

                            @endfor
                        </div>
                    </td>
                    <td>
                        <div class="advanced_table_stats">
                            <div class="tippy_tooltip" data-tippy-content="Total damage dealt to players"
                                onmouseover="startTippy()">
                                <img src="https://raw.communitydragon.org/pbe/game/assets/ux/tft/stageicons/announce_icon_combat.png"
                                    alt="comabt">
                                <p>{{ $orderedSummoners[$i]['total_damage_to_players'] }}</p>

                            </div>
                            <div class="tippy_tooltip" data-tippy-content="Time alive" onmouseover="startTippy()">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
                                    height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8s-3.58 8-8 8zm.5-13H11v6l5.25 3.15l.75-1.23l-4.5-2.67z" />
                                </svg>
                                <p>{{ gmdate('i:s', $orderedSummoners[$i]['time_eliminated']) }}</p>

                            </div>
                            <div class="tippy_tooltip" data-tippy-content="Total board value"
                                onmouseover="startTippy()">
                                <img src="https://raw.communitydragon.org/latest/plugins/rcp-fe-lol-career-stats/global/default/category_income.png"
                                    alt="comabt">
                                <p>{{ $boardValueSummoners[$i] }}</p>

                            </div>
                            <div class="tippy_tooltip" data-tippy-content="Left gold" onmouseover="startTippy()">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
                                    height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5 9a1 1 0 0 1 1 1a6.97 6.97 0 0 1 4.33 1.5h2.17c1.333 0 2.53.58 3.354 1.5H19a5 5 0 0 1 4.516 2.851C21.151 18.972 17.322 21 13 21c-2.79 0-5.15-.603-7.06-1.658A.998.998 0 0 1 5 20H2a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h3zm1.001 3L6 17.022l.045.032C7.84 18.314 10.178 19 13 19c3.004 0 5.799-1.156 7.835-3.13l.133-.133l-.12-.1a2.994 2.994 0 0 0-1.643-.63L19 15h-2.111c.072.322.111.656.111 1v1H8v-2l6.79-.001l-.034-.078a2.501 2.501 0 0 0-2.092-1.416L12.5 13.5H9.57A4.985 4.985 0 0 0 6.002 12zM4 11H3v7h1v-7zm14-6a3 3 0 1 1 0 6a3 3 0 0 1 0-6zm0 2a1 1 0 1 0 0 2a1 1 0 0 0 0-2zm-7-5a3 3 0 1 1 0 6a3 3 0 0 1 0-6zm0 2a1 1 0 1 0 0 2a1 1 0 0 0 0-2z" />
                                </svg>
                                <p>{{ $orderedSummoners[$i]['gold_left'] }}</p>
                            </div>
                        </div>

                    </td>

                </tr>
            @endfor
        </table>
    </div>

    <div class="advanced_desktop_close" wire:click="closeExtendMatchData">
        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
            preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
            <path fill="currentColor"
                d="m19.41 18l7.29-7.29a1 1 0 0 0-1.41-1.41L18 16.59l-7.29-7.3A1 1 0 0 0 9.3 10.7l7.29 7.3l-7.3 7.29a1 1 0 1 0 1.41 1.41l7.3-7.29l7.29 7.29a1 1 0 0 0 1.41-1.41Z"
                class="clr-i-outline clr-i-outline-path-1" />
            <path fill="none" d="M0 0h36v36H0z" />
        </svg>
    </div>

    <div class="advanced_desktop_layer"></div>
</div>
