@extends('layout.match_layout')
@section('match_content')
    @if ($profile_data == 'no')
        @include('match.components.not_found')
    @else
        <div class="layer_primary"></div>
        @if (session('status'))
            <div class="alert_bookmark">
                <p>{{ session('status') }}</p>
                <svg class="alert_bookmark_close" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                    width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29l-4.3 4.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l4.29-4.3l4.29 4.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42Z" />
                </svg>
            </div>
        @endif
        <div class="match">

            <div class="match_login">
                @guest
                    <a class="login_btn" href="/login" style="color:#FFF; text-decoration:none;">LOGIN</a>
                @else
                    @php
                        $bookmarksDB = DB::table('bookmarks')->get();
                        $bookmarks = [];
                        
                        for ($i = 0; $i < count($bookmarksDB); $i++) {
                            if ($bookmarksDB[$i]->id_user == Auth::user()->id) {
                                $bookmarks = json_decode($bookmarksDB[$i]->saves, true);
                            }
                        }
                        // dd();
                    @endphp
                    <div class="home_bookmarks">
                        <div class="home_bookmarks_btn">
                            <div class="">{{ Auth::user()->name }}</div>
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                                <path fill="currentColor"
                                    d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z" />
                            </svg>
                        </div>
                        <div class="home_bookmarks_dropdown hidden_bookmark">

                            <div class="home_bookmarks_dropdown_players">
                                <div class="home_bookmarks_dropdown_players_title">
                                    <p>Bookmarks</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
                                        height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M400 0H176a64.11 64.11 0 0 0-62 48h228a74 74 0 0 1 74 74v304.89l22 17.6a16 16 0 0 0 19.34.5a16.41 16.41 0 0 0 6.66-13.42V64a64 64 0 0 0-64-64Z" />
                                        <path fill="currentColor"
                                            d="M320 80H112a64 64 0 0 0-64 64v351.62A16.36 16.36 0 0 0 54.6 509a16 16 0 0 0 19.71-.71L216 388.92l141.69 119.32a16 16 0 0 0 19.6.79a16.4 16.4 0 0 0 6.71-13.44V144a64 64 0 0 0-64-64Z" />
                                    </svg>


                                </div>
                                @if (count($bookmarks) == 0)
                                    <p style="text-align: center; padding:1rem 0; color:gray;">No bookmarks yet...</p>
                                @else
                                    @for ($i = 0; $i < count($bookmarks); $i++)
                                        <a class="home_bookmarks_dropdown_players_player"
                                            href="/{{ $bookmarks[$i]['region'] }}/{{ $bookmarks[$i]['name'] }}">
                                            <p>#{{ $bookmarks[$i]['region'] }}</p>
                                            <p class="home_bookmarks_dropdown_players_player_name">
                                                {{ $bookmarks[$i]['name'] }}</p>
                                        </a>
                                    @endfor
                                @endif
                            </div>

                            <div class="home_bookmarks_dropdown_logout">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                                    <path fill="currentColor"
                                        d="M6 30h12a2.002 2.002 0 0 0 2-2v-3h-2v3H6V4h12v3h2V4a2.002 2.002 0 0 0-2-2H6a2.002 2.002 0 0 0-2 2v24a2.002 2.002 0 0 0 2 2Z" />
                                    <path fill="currentColor"
                                        d="M20.586 20.586L24.172 17H10v-2h14.172l-3.586-3.586L22 10l6 6l-6 6l-1.414-1.414z" />
                                </svg>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </div>
                    </div>
                @endguest
            </div>
            <div class="match_right">
                <div class="match_history">
                    @include('match.components.single_match')
                </div>
            </div>

            <div class="match_left">
                <div class="match_home">
                    <a href="/">
                        <p>Back home</p>
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <path d="m8 5l-5 5l5 5" />
                                <path d="M3 10h8c5.523 0 10 4.477 10 10v1" />
                            </g>
                        </svg>
                    </a>
                </div>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="/js/script.js"></script>
@endsection
