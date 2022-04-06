@extends('layout.match_layout')
@section('match_content')
    @if ($profile_data == 'no')
        @include('match.components.not_found')
    @else
        <div class="layer_primary"></div>
        <div class="match">
            {{-- {{$region}}
    {{$summonerName}} --}}
            <div class="match_login">
                <h1 class="login_btn">LOGIN</h1>
            </div>
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

        <div class="layer hidden_popup">

        </div>

        <div class="popup popup_login hidden_popup">
            <svg class="popup_LOGIN_close" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                viewBox="0 0 24 24" style=" fill:#94a1b2;">
                <path
                    d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z">
                </path>
            </svg>

            <form class="popup_form">
                <p class="popup_form_title">LOGIN</p>

                <div class="popup_form_center">
                    <div class="popup_form_input">
                        <label for="username"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <title>Person</title>
                                <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                                <path
                                    d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                    fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            </svg></label>
                        <input id="username" type="text" placeholder="Username">
                    </div>

                    <div class="popup_form_input">
                        <label for="password"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <title>Lock Closed</title>
                                <path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                <rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg></label>
                        <input id="password" type="password" placeholder="Password">
                    </div>


                    <button type="Submit" class="popup_form_btn">Sign in!</button>
                </div>



                <p class="popup_form_footer">Don't have an account? <span
                        class="popup_form_footer_link register_btn">Register.</span></p>
            </form>
        </div>


        <!-- sa se mai poata schimba intre ele popup urile de login si register (clase diferite la close btn uri si la open) -->
        <div class="popup popup_register hidden_popup">
            <svg class="popup_REGISTER_close" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                viewBox="0 0 24 24" style=" fill:#94a1b2;">
                <path
                    d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z">
                </path>
            </svg>

            <form class="popup_form">
                <p class="popup_form_title">REGISTER</p>

                <div class="popup_form_center">
                    <div class="popup_form_input">
                        <label for="username"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <title>Person</title>
                                <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                                <path
                                    d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                    fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            </svg></label>
                        <input id="username" type="text" placeholder="Username">
                    </div>

                    <div class="popup_form_input">
                        <label for="password"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <title>Lock Closed</title>
                                <path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                <rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg></label>
                        <input id="password" type="password" placeholder="Password">
                    </div>

                    <div class="popup_form_input">
                        <label for="password_repeat"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <title>Lock Closed</title>
                                <path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                <rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg></label>
                        <input id="password_repeat" type="password" placeholder="Confirm password">
                    </div>


                    <button type="Submit" class="popup_form_btn">Register!</button>
                </div>



                <p class="popup_form_footer">Already have an account?<span
                        class="popup_form_footer_link login_btn_in">Login.</span></p>
            </form>

        </div>
    @endif
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="/js/script.js"></script>
@endsection
