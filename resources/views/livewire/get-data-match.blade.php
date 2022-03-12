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
            @include('livewire.components.quick_stats')
            <button wire:click="extendMatchData"
                class="game_extend  game_extend_{{ getClass($match['info']['participants'][$mainPlayerPOZ]['placement']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.3em" height="1.3em"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                    <path fill="currentColor"
                        d="M342 88H120c-17.7 0-32 14.3-32 32v224c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16V168h174c8.8 0 16-7.2 16-16v-48c0-8.8-7.2-16-16-16zm578 576h-48c-8.8 0-16 7.2-16 16v176H682c-8.8 0-16 7.2-16 16v48c0 8.8 7.2 16 16 16h222c17.7 0 32-14.3 32-32V680c0-8.8-7.2-16-16-16zM342 856H168V680c0-8.8-7.2-16-16-16h-48c-8.8 0-16 7.2-16 16v224c0 17.7 14.3 32 32 32h222c8.8 0 16-7.2 16-16v-48c0-8.8-7.2-16-16-16zM904 88H682c-8.8 0-16 7.2-16 16v48c0 8.8 7.2 16 16 16h174v176c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16V120c0-17.7-14.3-32-32-32z" />
                </svg>
            </button>

            <div wire:loading class="advanced_desktop">
                <svg class="game_loading match_loading" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                    width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
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
            </div>



            @if ($isOpenAdvanced == 1)
                @include('livewire.components.advanced_data')
            @endif
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
