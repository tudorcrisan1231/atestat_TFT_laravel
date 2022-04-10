{{-- <div>
    <p>test profile {{$profile_data->name}}</p>
</div> --}}

@php
$duration = (int) (round(microtime(true) * 1000) - $profile_data->revisionDate);
// $time;
$hours = floor(($duration / (1000 * 60 * 60)) % 24);
$days = floor($duration / (24 * 60 * 60 * 1000));

if ($duration <= 86399999) {
    $time = $hours . ' hours' /* + minutes + ":" + seconds*/;
} else {
    if ($duration > 86399999 && $duration <= 172799999) {
        $time = $days . ' day';
    } else {
        $time = $days . ' days';
    }
}

//verific daca este sau nu user ul salvat in bookmark uri
// dd($bookmarks);

@endphp

@guest
    @php
    $isSaved = 0;
    @endphp
@else
    @php
    $isSaved = 0;

    for ($i = 0; $i < count($bookmarks); $i++) {
        // dd($bookmarks[$i]['region'], $region, $bookmarks[$i]['name'], $profile_data->name);
        if ($bookmarks[$i]['region'] == $region && $bookmarks[$i]['name'] == $profile_data->name) {
            $isSaved = 1;
        }
    }
    @endphp
@endguest


<div class="profile">
    <div class="profile_img">
        <img src="http://ddragon.leagueoflegends.com/cdn/11.22.1/img/profileicon/{{ $profile_data->profileIconId }}.png"
            alt="profile icon" />
    </div>
    <div class="profile_stats">
        <h1 class="profile_name">
            <p style="white-space:nowrap;">{{ $profile_data->name }}
            </p>
            @guest
                <a href="/login">
                    <svg class="bookmark bookmark_open" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                        </g>
                    </svg>
                </a>
            @else
                <form action="/addBookmark" method="post" class="{{ $isSaved == 1 ? 'hidden' : '' }}">
                    @csrf

                    <input type="hidden" value="{{ $region }}" name="region">
                    <input type="hidden" value="{{ $profile_data->name }}" name="name">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <button type="submit" class="bookmark_btn">
                        <svg class="bookmark bookmark_open" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em"
                            height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <g fill="currentColor">
                                <path
                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            </g>
                        </svg>
                    </button>
                </form>

                <form action="/deleteBookmark" method="POST" class="{{ $isSaved == 1 ? '' : 'hidden' }}">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <input type="hidden" value="{{ $region }}" name="region">
                    <input type="hidden" value="{{ $profile_data->name }}" name="name">
                    <button type="submit" class="bookmark_btn">
                        <svg class="bookmark bookmark_close" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z" />
                        </svg>
                    </button>

                </form>
            @endguest


        </h1>
        <p>Level: {{ $profile_data->summonerLevel }}</p>
        <p>Last updated: {{ $time }} ago</p>

    </div>

</div>

<script>
    document.querySelector('.bookmark_close').addEventListener('click', function() {
        console.log('edlete');
    });
</script>
