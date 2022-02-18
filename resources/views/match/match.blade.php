@extends('layout.match_layout')
@section('match_content')

@if($profile_data == 'no')

    @include('match.components.not_found')

@else

<div class="match">
    {{-- {{$region}}
    {{$summonerName}}     --}}

    <div class="match_left">
        <div class="match_profile">
            @include('match.components.profile')
        </div>
        <div class="match_ranks">
            <p>rank</p>
    
        </div>
    </div>

    <div class="match_right">
        <div class="match_summary">
            <p>matches summary</p>

        </div>
    
        <div class="match_history">
            <p>matches history</p>
    
        </div>
    </div>

</div>

@endif




@endsection