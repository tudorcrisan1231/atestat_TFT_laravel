@php
$time_alive = gmdate('i:s', $match['info']['participants'][$mainPlayerPOZ]['time_eliminated']);

$board_value = 0;

//1 campioni ca sa l fac de 1
//3 campioni ca sa l fac de 2
//9 campioni ca sa l fac de 3

for ($i = 0; $i < count($match['info']['participants'][$mainPlayerPOZ]['units']); $i++) {
    if ($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['tier'] == 1) {
        $board_value += ($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['rarity'] + 1) * 1;
    } elseif ($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['tier'] == 2) {
        $board_value += ($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['rarity'] + 1) * 3;
    } elseif ($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['tier'] == 3) {
        $board_value += ($match['info']['participants'][$mainPlayerPOZ]['units'][$i]['rarity'] + 1) * 9;
    }
}
@endphp

<div class="game_stats">
    <div class="game_stats_item tippy_tooltip" data-tippy-content="Total damage dealt to players"
        onmouseover="startTippy()">
        <img src="https://raw.communitydragon.org/pbe/game/assets/ux/tft/stageicons/announce_icon_combat.png"
            alt="comabt">
        <p>{{ $match['info']['participants'][$mainPlayerPOZ]['total_damage_to_players'] }}</p>
    </div>
    <div class="game_stats_item tippy_tooltip" data-tippy-content="Time alive" onmouseover="startTippy()">
        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8s-3.58 8-8 8zm.5-13H11v6l5.25 3.15l.75-1.23l-4.5-2.67z" />
        </svg>
        <p>{{ $time_alive }}</p>
    </div>
    <div class="game_stats_item tippy_tooltip" data-tippy-content="Total board value" onmouseover="startTippy()">
        <img src="https://raw.communitydragon.org/latest/plugins/rcp-fe-lol-career-stats/global/default/category_income.png"
            alt="comabt">
        <p>{{ $board_value }}</p>
    </div>
</div>
