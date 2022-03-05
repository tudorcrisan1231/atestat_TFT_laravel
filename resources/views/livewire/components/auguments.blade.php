<div class="game_auguments">

    @php
        $augments = [];
        for ($i = 0; $i < count($augments_itemsJSON); $i++) {
            //iau datele de la api ul oficial si verific in json ul cu iteme si augments daca exista, salvand in $augments id ul imaginii si numele fiecarui augument din meci;
            for ($j = 0; $j < count($match['info']['participants'][$mainPlayerPOZ]['augments']); $j++) {
                if ($match['info']['participants'][$mainPlayerPOZ]['augments'][$j] == $augments_itemsJSON[$i]['nameId']) {
                    array_push($augments, [strtolower($augments_itemsJSON[$i]['loadoutsIcon']), $augments_itemsJSON[$i]['name']]); //$augments[0][a sau b]  a  = id ul img ului, b = numele
                }
            }
        }
    @endphp

    {{-- <button id="myButton">My button</button> --}}
    @for ($i = 0; $i < count($augments); $i++)
        <img class="game_auguments_img tippy_tooltip"
            src="https://raw.communitydragon.org/latest/game/assets/maps/{{ substr($augments[$i][0], 34) }}"
            data-tippy-content="{{ $augments[$i][1] }}" onmouseover="startTippy()">
    @endfor

</div>
