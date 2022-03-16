<div class="game_details">
    <div class="game_details_place">
        <p class="{{ getClass($match['info']['participants'][$mainPlayerPOZ]['placement']) }}">
            #<span
                class="game_details_place_nr">{{ $match['info']['participants'][$mainPlayerPOZ]['placement'] }}</span>
        </p>
    </div>
    <div class="game_details_type">
        <p class="matchTYPE">{{ $matchType }}</p>

    </div>
    <div class="game_details_duration">
        {{ $game_duration }}
    </div>
    <div class="game_details_ago">
        {{ msToTime(round(microtime(true) * 1000) - $match['info']['game_datetime']) }} ago
    </div>
</div>
