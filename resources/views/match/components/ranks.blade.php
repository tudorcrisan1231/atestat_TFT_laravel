<div class="ranks">
    @if ($ranks[0] == 'unranked')
        <div class="ranks_rank">
            <div class="ranks_rank_img">
                <img src="/images/unranked.png" alt="unranked" />
            </div>
            <div class="ranks_rank_text">
                <h3 class="ranks_rank_title">TFT Ranked</h3>
                <p style="color: var(--color-win)">UNRANKED</p>
            </div>
        </div>
    @else
        <div class="ranks_rank">
            <div class="ranks_rank_img">
                <img src="/images/{{ $ranks[0]->tier }}.png" alt="" />
            </div>
            <div class="ranks_rank_text">
                <h3 class="ranks_rank_title">TFT Ranked</h3>
                <p style="color: var(--color-win)">
                    {{ $ranks[0]->tier }} {{ $ranks[0]->rank }}
                </p>
                <p>
                    {{ $ranks[0]->leaguePoints }}LP /
                    <span class="ranks_rank_color">{{ $ranks[0]->wins }}W {{ $ranks[0]->losses }}L</span>
                </p>
                <p class="ranks_rank_color">
                    Win ratio:
                    {{ number_format(((int) $ranks[0]->wins / ((int) $ranks[0]->wins + (int) $ranks[0]->losses)) * 100, 1, '.', '') }}%
                </p>
            </div>
        </div>
    @endif

    @if ($ranks[1] == 'unranked')
        <div class="ranks_rank">
            <div class="ranks_rank_img">
                <img src="/images/unranked.png" alt="unranked" />
            </div>
            <div class="ranks_rank_text">
                <h3 class="ranks_rank_title">TFT Hyper Roll</h3>
                <p style="color: var(--color-win)">UNRANKED</p>
            </div>
        </div>
    @else
        <div class="ranks_rank">
            <div class="ranks_rank_img">
                <img src="https://raw.communitydragon.org/pbe/game/assets/ux/tft/ceremonies/rank_hyperroll/tft_turbo_rankceremony_badge_{{ strtolower($ranks[1]->ratedTier) }}.tft_turbomode.png"
                    alt="" />
            </div>
            <div class="ranks_rank_text">
                <h3 class="ranks_rank_title">TFT Hyper Roll</h3>
                <p style="color: var(--color-win)">
                    {{ $ranks[1]->ratedTier }}
                </p>
                <p>
                    {{ $ranks[1]->ratedRating }}PTS /
                    <span class="ranks_rank_color">{{ $ranks[1]->wins }}W {{ $ranks[1]->losses }}L</span>
                </p>
                <p class="ranks_rank_color">
                    Win ratio:
                    {{ number_format(((int) $ranks[1]->wins / ((int) $ranks[1]->wins + (int) $ranks[1]->losses)) * 100, 1, '.', '') }}%
                </p>
            </div>
        </div>
    @endif

    {{-- {{$ranks[1]->ratedTier}} --}}
</div>
