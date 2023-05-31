                    <div class="user-dashboard-aside">

                        {{-- <div class="frontend-user-photo">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ asset(url(auth()->user()->profile_photo)) }}" class="rounded-circle mx-auto d-block" alt="">
                            @endif

                            <h6 class="text-center mt-3">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                            <p class="text-center">{{ auth()->user()->created_at->format('F j, Y') }}</p>
                        </div> --}}

                        <div class="frontend-user-photo">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ asset(auth()->user()->profile_photo) }}" class="rounded-circle mx-auto d-block" alt="Profile Photo">
                            @else
                                <img src="{{ Avatar::create(auth()->user()->first_name)->toBase64() }}" class="rounded-circle mx-auto d-block" alt="Avatar">
                            @endif

                            <h6 class="text-center mt-3">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                            <p class="text-center">{{ auth()->user()->created_at->format('F j, Y') }}</p>
                        </div>

                        <ul class="nav flex-column user-dashboard-sidebar">
                            <li class="">
                                <a class="{{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                            <li class="">
                                <a class="{{ request()->is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">Profile</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ url('/') }}">Orders</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ url('/') }}">Wishlist</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ url('/') }}">Address</a>
                            </li>
                            <li class="">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    </div>
