<div wire:init="getDataSigleMatch">
    @if ($match)
        @php
            $mainPlayerPOZ; //get main player poz
            for ($i = 0; $i < count($match['info']['participants']); $i++) {
                if ($match['info']['participants'][$i]['puuid'] == $puuid) {
                    $mainPlayerPOZ = $i;
                }
            }
            
            //get companion skin
            $companionIMG;
            for ($i = 0; $i < count($companionJSON); $i++) {
                if ($match['info']['participants'][$mainPlayerPOZ]['companion']['content_ID'] == $companionJSON[$i]['contentId']) {
                    $companionIMG = $companionJSON[$i]['loadoutsIcon'];
                }
            }
            
            $companionIMG = substr($companionIMG, 49); //formatez putin formatul in care primesc datale, tai primele 49 caractere;
            
            //get match type (hyper roll, ranked etc..)
            $matchType = $queueJSON[0][$match['info']['queue_id']]['description'];
            
            function getClass($place)
            {
                if ($place == 1) {
                    return 'first';
                } elseif ($place <= 4) {
                    return 'win';
                } else {
                    return 'lose';
                }
            }
            
            $game_duration = gmdate('i:s', $match['info']['game_length']); //functie php care transforma secundele in min:sec
            
            $gameTimeAgo;
            
            function msToTime($duration)
            {
                $minutes = floor(($duration / (1000 * 60)) % 60);
                $hours = floor(($duration / (1000 * 60 * 60)) % 24);
                $days = floor($duration / (24 * 60 * 60 * 1000));
            
                //hours = (hours < 10) ? "0" + hours : hours;
                $minutes = $minutes < 10 ? '0' . $minutes : $minutes;
                //seconds = (seconds < 10) ? "0" + seconds : seconds;
            
                if ($duration < 3600000) {
                    return $minutes . ' minutes';
                } elseif ($duration <= 86399999) {
                    return $hours . ' hours' /* + minutes + ":" + seconds*/;
                } else {
                    if ($duration > 86399999 && $duration <= 172799999) {
                        return $days . ' day';
                    } else {
                        return $days . ' days';
                    }
                }
            }
            
        @endphp
        {{-- {{ $companionIMG }} --}}
        <div class="game {{ 'game_' . getClass($match['info']['participants'][$mainPlayerPOZ]['placement']) }}">

            <div class="game_details">
                <div class="game_details_place">
                    <p class="{{ getClass($match['info']['participants'][$mainPlayerPOZ]['placement']) }}">
                        #{{ $match['info']['participants'][$mainPlayerPOZ]['placement'] }}</p>
                </div>
                <div class="game_details_type">
                    {{ $matchType }}
                </div>
                <div class="game_details_duration">
                    {{ $game_duration }}
                </div>
                <div class="game_details_ago">
                    {{ msToTime(round(microtime(true) * 1000) - $match['info']['game_datetime']) }} ago
                </div>
            </div>

            <div class="game_profile">
                <img class="game_companionIMG"
                    src="https://raw.communitydragon.org/latest/plugins/rcp-be-lol-game-data/global/default/assets/loadouts/companions/{{ strtolower($companionIMG) }}"
                    alt="companion img">
                <p>Level: {{ $match['info']['participants'][$mainPlayerPOZ]['level'] }}</p>
            </div>


            <div class="game_traits">

            </div>

            <div class="game_auguments">

            </div>

            <div class="game_champs">

            </div>

            <div class="game_participants">
                <div class="game_participants_left">

                </div>
                <div class="game_participants_right">

                </div>
            </div>


        </div>
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
