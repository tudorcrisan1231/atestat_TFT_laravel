@extends('layout.layout')

@section('content')
    <div class="popup popup_register">
        <a href="/" class="popup_form_back">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>
        </a>

        <form class="popup_form" method="POST" action="{{ route('register') }}">
            @csrf
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
                    <div>
                        <input id="name" placeholder="Username" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                            required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="popup_form_input">
                    <label for="username"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
                            height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5.25 4h13.5a3.25 3.25 0 0 1 3.245 3.066L22 7.25v9.5a3.25 3.25 0 0 1-3.066 3.245L18.75 20H5.25a3.25 3.25 0 0 1-3.245-3.066L2 16.75v-9.5a3.25 3.25 0 0 1 3.066-3.245L5.25 4h13.5h-13.5ZM20.5 9.373l-8.15 4.29a.75.75 0 0 1-.603.043l-.096-.042L3.5 9.374v7.376a1.75 1.75 0 0 0 1.606 1.744l.144.006h13.5a1.75 1.75 0 0 0 1.744-1.607l.006-.143V9.373ZM18.75 5.5H5.25a1.75 1.75 0 0 0-1.744 1.606L3.5 7.25v.429l8.5 4.473l8.5-4.474V7.25a1.75 1.75 0 0 0-1.607-1.744L18.75 5.5Z" />
                        </svg></label>
                    <div>
                        <input id="email" placeholder="Email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="popup_form_input">
                    <label for="password"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                            viewBox="0 0 512 512">
                            <title>Lock Closed</title>
                            <path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                            <rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                        </svg></label>
                    <div>
                        <input id="password" placeholder="Password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="popup_form_input">
                    <label for="password_repeat"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                            viewBox="0 0 512 512">
                            <title>Lock Closed</title>
                            <path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                            <rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                        </svg></label>
                    <div>
                        <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>


                <button type="Submit" class="popup_form_btn">Register!</button>
            </div>



            <p class="popup_form_footer">Already have an account?<a class="popup_form_footer_link login_btn_in"
                    href="/login" style="color:inherit;">Login.</a></p>
        </form>

    </div>
@endsection
