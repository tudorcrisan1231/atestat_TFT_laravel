{{-- <div>
    <p>test profile {{$profile_data->name}}</p>
</div> --}}

@php
$duration = (int)(round(microtime(true) * 1000) - $profile_data->revisionDate);
// $time;
    $hours = floor(($duration / (1000 * 60 * 60)) % 24);
    $days = floor($duration / (24 * 60 * 60 * 1000));

    if ($duration <= 86399999) {
        $time = $hours . " hours" /* + minutes + ":" + seconds*/;
    } else {
        if ($duration > 86399999 && $duration <= 172799999) {
        $time = $days . " day";
        } else {
        $time = $days . " days";
        }
    }
@endphp

<div class="profile">
    <div class="profile_img">
      <img
        src="http://ddragon.leagueoflegends.com/cdn/11.22.1/img/profileicon/{{$profile_data->profileIconId}}.png" alt="profile icon"/>
    </div>
    <div class="profile_stats">
      <h1 class="profile_name">
        <p style="white-space:nowrap;">{{ $profile_data->name }}</p>
        <svg 
          class="bookmark"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true"
          role="img"
          width="1em"
          height="1em"
          preserveAspectRatio="xMidYMid meet"
          viewBox="0 0 16 16"
        >
          <g fill="currentColor">
            <path
              d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"
            />
          </g>
        </svg>
      </h1>
      <p>Level: {{ $profile_data->summonerLevel }}</p>
      <p>Last updated: {{ $time }} ago</p>
    </div>
</div>