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
        
        $companionsIMG = [];
        for ($j = 0; $j < count($orderedSummoners); $j++) {
            for ($i = 0; $i < count($companionJSON); $i++) {
                if ($orderedSummoners[$j]['companion']['content_ID'] == $companionJSON[$i]['contentId']) {
                    array_push($companionsIMG, substr($companionJSON[$i]['loadoutsIcon'], 49));
                }
            }
        }
        
        $augmentsSummoners = [];
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
        
        // dd($augmentsSummoners);
        
    @endphp

    <table style="width: 100%" class="advanced_table">
        <tr style="background-color: rgba(0, 0, 0, 0.1);">
            <th>Rank</th>
            <th>Summoner</th>
            <th>Damage done</th>
            <th>Alive</th>
            <th>Augments</th>
            <th>Traits</th>
            <th>Units</th>
            <th>Left Gold</th>
        </tr>
        @for ($i = 0; $i < count($summonerNames); $i++)
            <tr>
                <td>#{{ $i + 1 }}</td>
                <td class="advanced_table_profile">
                    <img class="game_companionIMG"
                        src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/loadouts/companions/{{ strtolower($companionsIMG[$i]) }}"
                        alt="companion img">
                    <p class="advanced_table_profile_level tippy_tooltip" data-tippy-content="Level"
                        onmouseover="startTippy()"> {{ $orderedSummoners[$i]['level'] }}</p>
                    <a target="_blank" href="/{{ $region }}/{{ $summonerNames[$i]['name'] }}">
                        {{ $summonerNames[$i]['name'] }}
                    </a>
                </td>
                <td>{{ $orderedSummoners[$i]['total_damage_to_players'] }}</td>
                <td>{{ gmdate('i:s', $orderedSummoners[$i]['time_eliminated']) }}</td>
                <td>
                    @for ($j = 0; $j < count($augmentsSummoners[$i]); $j++)
                        <img class="game_auguments_img tippy_tooltip"
                            src="https://raw.communitydragon.org/latest/game/assets/maps/{{ substr($augmentsSummoners[$i][$j][0], 34) }}"
                            data-tippy-content="{{ $augmentsSummoners[$i][$j][1] }}" onmouseover="startTippy()">
                    @endfor
                </td>
                <td>traits</td>
                <td>campioni</td>
                <td>{{ $orderedSummoners[$i]['gold_left'] }}</td>
            </tr>
        @endfor
    </table>

</div>
