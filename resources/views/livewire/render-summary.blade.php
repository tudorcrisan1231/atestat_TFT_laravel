<div wire:init="getDataSummary">
    @if ($matchData)
        @php
            $mainPlayerPoz = []; //pozitile main player ului in cele 10 meciuri
            $wins = 0;
            $defeats = 0;
            $first = 0;
            $avg_place = 0;
            $units = [];
            $traits = [];
            $items = [];
            $places = [];
            for ($i = 0; $i < count($matchData); $i++) {
                for ($j = 0; $j < count($matchData[$i]['info']['participants']); $j++) {
                    if ($matchData[$i]['info']['participants'][$j]['puuid'] == $puuid) {
                        $mainPlayerPoz[] = $j;
                    }
                }
                if ($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['placement'] == 1) {
                    $first++;
                } elseif ($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['placement'] >= 5) {
                    $defeats++;
                } elseif ($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['placement'] < 5) {
                    $wins++;
                }
            
                for ($j = 0; $j < count($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['units']); $j++) {
                    $units[] = $matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['units'][$j]['character_id'];
            
                    for ($h = 0; $h < count($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['units'][$j]['items']); $h++) {
                        $items[] = $matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['units'][$j]['items'][$h];
                    }
                }
                for ($j = 0; $j < count($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['traits']); $j++) {
                    if ($matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['traits'][$j]['tier_current'] > 0) {
                        $traits[] = $matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['traits'][$j]['name'];
                    }
                }
            
                $places[] = $matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['placement'];
                $avg_place += $matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['placement'];
                // echo $mainPlayerPoz[$i] . ' ';
            }
            
            $avg_place = round($avg_place / count($matchData), 1);
            
            $units = array_count_values($units); //calculeaza de cate ori apare un caracter in array
            $traits = array_count_values($traits);
            $items = array_count_values($items);
            
            arsort($units); //il sorteaza de la mare la mic
            arsort($traits);
            arsort($items);
            
            $units = array_keys($units); //le pun key uri
            $traits = array_keys($traits);
            $items = array_keys($items);
            
            // dd($units[0], $traits[0], $items[0]); //le afiseaza [0], adica primul, cel cu cele mai multe aparitii
            
            $itemDesc = []; //datele despre cel mai folosit item [numele, path ul catre icon]
            
            for ($h = 0; $h < count($augments_itemsJSON); $h++) {
                if ($augments_itemsJSON[$h]['id'] == $items[0]) {
                    // echo $augments_itemsJSON[$h]['name'];
                    array_push($itemDesc, $augments_itemsJSON[$h]['name'], $augments_itemsJSON[$h]['loadoutsIcon']);
                }
            }
            // dd($places);
            
            $places_times = [0, 0, 0, 0, 0, 0, 0, 0];
            for ($i = 0; $i < count($places); $i++) {
                if ($places[$i] == 1) {
                    $places_times[0]++;
                }
                if ($places[$i] == 2) {
                    $places_times[1]++;
                }
                if ($places[$i] == 3) {
                    $places_times[2]++;
                }
                if ($places[$i] == 4) {
                    $places_times[3]++;
                }
                if ($places[$i] == 5) {
                    $places_times[4]++;
                }
                if ($places[$i] == 6) {
                    $places_times[5]++;
                }
                if ($places[$i] == 7) {
                    $places_times[6]++;
                }
                if ($places[$i] == 8) {
                    $places_times[7]++;
                }
            }
            
            // dd($places_times);
            
        @endphp


        {{-- @for ($i = 0; $i < count($matchData); $i++)
            <p>{{ $matchData[$i]['info']['participants'][$mainPlayerPoz[$i]]['placement'] }}</p>
        @endfor --}}
        <div class="summary">
            <div class="summary_title">
                Last 10 matches statistics
            </div>
            <div class="summary_winRate summary_box">
                <p>Win rate</p>
                <div class="summary_winRate_chart">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="summary_places summary_box">
                <p>Top places</p>
                <div class="summary_places_chart">
                    <canvas id="myChartPlace"></canvas>
                </div>
            </div>
            <div class="summary_avg summary_box">
                <p>Avg. Rank</p>
                <p style="font-weight: bold">{{ $avg_place }}</p>
            </div>
            <div class="summary_champ summary_box">
                <p>Favorite Unit:</p>
                @if (substr($units[0], 5) == '_Vi')
                    <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/tft6_vi/hud/tft6_vi.tft_set6_stage2.png"
                        alt="vi" class="game_champs_img tippy_tooltip" data-tippy-content="{{ substr($units[0], 6) }}"
                        onmouseover="startTippy()">

                    {{-- la campionul VI, apare o eroare in documnetatie si trebuie pus manual --}}
                @else
                    <img src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($units[0]) }}/hud/{{ strtolower($units[0]) }}.tft_set6_stage2.png"
                        alt="" class="game_champs_img tippy_tooltip"
                        onerror="this.src='https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/characters/{{ strtolower($units[0]) }}/hud/{{ strtolower($units[0]) }}_square.tft_set6.png';"
                        data-tippy-content="{{ substr($units[0], 5) }}" onmouseover="startTippy()">
                    {{-- sunt 2 tipuri de png uri cu campionii din tft, una cu campionii simpli si una cu campionii din stage2, pun functia onerror, care daca nu mi randeaza prima img, mi o pune a pe a doua cu stage2 --}}
                @endif
            </div>
            <div class="summary_trait summary_box">
                <p>Most played trait:</p>
                @if ($traits[0] == 'Set6_Hextech')
                    <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_hextech.png"
                        alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                        style="background-image: url('/images/tier0.png'); " data-tippy-content="Hextech"
                        onmouseover="startTippy()">
                @elseif($traits[0] == 'Set6_Bodyguard')
                    <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_6_hero.png"
                        alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                        style="background-image: url('/images/tier0.png'); " data-tippy-content="Bodyguard"
                        onmouseover="startTippy()">
                @elseif(strtolower(substr($traits[0], 3)) == '6_mutant')
                    <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_6_experimental.png"
                        alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                        style="background-image: url('/images/tier0.png'); " data-tippy-content="Mutant"
                        onmouseover="startTippy()">
                @else
                    <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_{{ strtolower(substr($traits[0], 3)) }}.png"
                        alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                        style="background-image: url('/images/tier0.png'); "
                        data-tippy-content="{{ ucfirst(strtolower(substr($traits[0], 5))) }}"
                        onmouseover="startTippy()">
                @endif
            </div>
            <div class="summary_item summary_box">
                <p>Most used item:</p>
                <img class="summary_item_img tippy_tooltip"
                    src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/maps/particles/tft/{{ strtolower(substr($itemDesc[1], 48)) }}"
                    alt="items icon tft" data-tippy-content="{{ $itemDesc[0] }}" onmouseover="startTippy()">
            </div>
        </div>

        <script>
            function pieChartWinRate() {
                const wins = {!! json_encode($wins, JSON_HEX_TAG) !!};
                const defeats = {!! json_encode($defeats, JSON_HEX_TAG) !!};
                const first = {!! json_encode($first, JSON_HEX_TAG) !!};


                const data = {
                    labels: ['Wins', 'Defeats', 'First Place'],
                    datasets: [{
                        label: 'Dataset 1',
                        data: [wins, defeats, first],
                        backgroundColor: ['#2CB67D', '#F08080', '#f4c430'],
                    }]
                };

                const config = {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        }
                    },
                };


                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            }
            pieChartWinRate();


            function barChartTopPlaces() {
                const places_times = {!! json_encode($places_times, JSON_HEX_TAG) !!};

                const labels = ['#1', '#2', '#3', '#4', '#5', '#6', '#7', '#8'];
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Times',
                        data: [places_times[0], places_times[1], places_times[2], places_times[3], places_times[4],
                            places_times[5], places_times[6], places_times[7]
                        ],
                        borderColor: 'gray',
                        backgroundColor: 'lightgray',
                    }, ]
                };
                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        }
                    },
                };
                const myChart = new Chart(
                    document.getElementById('myChartPlace'),
                    config
                );
            }
            barChartTopPlaces();

            startTippy = () => {
                return tippy('.tippy_tooltip', {
                    content: 'Global content',
                    // trigger: 'click',
                });
            }
        </script>
    @else
        <svg class="game_loading" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
            height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
            <circle cx="12" cy="2" r="0" fill="currentColor">
                <animate attributeName="r" begin="0" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(45 12 12)">
                <animate attributeName="r" begin="0.125s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(90 12 12)">
                <animate attributeName="r" begin="0.25s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(135 12 12)">
                <animate attributeName="r" begin="0.375s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(180 12 12)">
                <animate attributeName="r" begin="0.5s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(225 12 12)">
                <animate attributeName="r" begin="0.625s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(270 12 12)">
                <animate attributeName="r" begin="0.75s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
            <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(315 12 12)">
                <animate attributeName="r" begin="0.875s" calcMode="spline" dur="1s"
                    keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                    values="0;2;0;0" />
            </circle>
        </svg>
    @endif


</div>
