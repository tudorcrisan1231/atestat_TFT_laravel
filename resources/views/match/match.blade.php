@extends('layout.match_layout')
@section('match_content')
    @if ($profile_data == 'no')
        @include('match.components.not_found')
    @else
        <div class="match">
            {{-- {{$region}}
    {{$summonerName}} --}}
            <div class="match_right">
                <div class="match_history">
                    @include('match.components.single_match')
                </div>
            </div>

            <div class="match_left">
                <div class="match_profile">
                    @include('match.components.profile')
                </div>
                <div class="match_ranks">
                    @include('match.components.ranks')
                </div>

                <div class="match_summary">
                    @include('match.components.summary')
                </div>
            </div>


        </div>
    @endif
@endsection

@section('js')
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="/js/script.js"></script>
@endsection
