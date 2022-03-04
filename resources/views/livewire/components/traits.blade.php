<div class="game_traits">
    @for ($i = 0; $i < count($traits); $i++)
        @if ($traits[$i]['tier_current'] > 0)
            <div class="game_traits_trait">


                <div class="game_traits_trait_img">
                    {{-- unde am if uri sunt exceptii, din documentatia ddragon si din requesturile de pe api --}}


                    @if ($traits[$i]['name'] == 'Set6_Hextech')
                        <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_hextech.png"
                            alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                            style="background-image: url('/images/tier{{ $traits[$i]['style'] }}.png'); "
                            data-tippy-content="{{ $traits[$i]['num_units'] }} Hextech" onmouseover="startTippy()">
                    @elseif($traits[$i]['name'] == 'Set6_Bodyguard')
                        <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_6_hero.png"
                            alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                            style="background-image: url('/images/tier{{ $traits[$i]['style'] }}.png'); "
                            data-tippy-content="{{ $traits[$i]['num_units'] }} Bodyguard" onmouseover="startTippy()">
                    @elseif(strtolower(substr($traits[$i]['name'], 3)) == '6_mutant')
                        <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_6_experimental.png"
                            alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                            style="background-image: url('/images/tier{{ $traits[$i]['style'] }}.png'); "
                            data-tippy-content="{{ $traits[$i]['num_units'] }} Mutant" onmouseover="startTippy()">
                    @else
                        <img src="https://raw.communitydragon.org/latest/game/assets/ux/traiticons/trait_icon_{{ strtolower(substr($traits[$i]['name'], 3)) }}.png"
                            alt="" class="game_traits_trait_img_TRAIT tippy_tooltip"
                            style="background-image: url('/images/tier{{ $traits[$i]['style'] }}.png'); "
                            data-tippy-content="{{ $traits[$i]['num_units'] }} {{ ucfirst(strtolower(substr($traits[$i]['name'], 5))) }}"
                            onmouseover="startTippy()">
                    @endif


                </div>


            </div>
        @endif
    @endfor
    {{-- <button id="myButton" class="tippy_tooltip">My
        button</button> --}}
</div>
