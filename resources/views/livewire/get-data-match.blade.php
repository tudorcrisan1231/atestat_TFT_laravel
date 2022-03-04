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
            
            //ordonez descrescator dupa nr tier ului
            function orderTierTraits($traits)
            {
                // $traits = $match['info']['participants'][$mainPlayerPOZ]['traits'];
            
                for ($i = 0; $i < count($traits); $i++) {
                    for ($j = $i; $j < count($traits); $j++) {
                        if ($traits[$j]['style'] > $traits[$i]['style']) {
                            $aux = $traits[$i];
                            $traits[$i] = $traits[$j];
                            $traits[$j] = $aux;
                        }
                    }
                }
                return $traits;
            }
            $traits = orderTierTraits($match['info']['participants'][$mainPlayerPOZ]['traits']);
            
        @endphp
        {{-- {{ $companionIMG }} --}}
        <div class="game {{ 'game_' . getClass($match['info']['participants'][$mainPlayerPOZ]['placement']) }}">
            @include('livewire.components.details')
            @include('livewire.components.profile')
            @include('livewire.components.traits')
            @include('livewire.components.auguments')
            @include('livewire.components.champs')
            @include('livewire.components.participants')
            <button
                class="game_extend  game_extend_{{ getClass($match['info']['participants'][$mainPlayerPOZ]['placement']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m4 9l8 8l8-8" />
                </svg>
            </button>
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
<script>
    startTippy = () => {
        return tippy('.tippy_tooltip', {
            content: 'Global content',
            // trigger: 'click',
        });
    }
</script>
