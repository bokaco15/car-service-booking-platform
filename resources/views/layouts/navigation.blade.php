<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">

        <!-- Hamburger (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- Primer dodatnih linkova --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('service.all') ? 'active' : '' }}"
                       href="{{ route('service.all') }}">
                        Servisi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('service.search.blade') ? 'active' : '' }}"
                       href="{{ route('service.search.blade') }}">
                        Pretrazi servise
                    </a>
                </li>
                @auth
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('service_owner'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('service.add') ? 'active' : '' }}"
                               href="{{route('service.add')}}">
                                Dodaj servise
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasRole('service_owner'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('owner.services') ? 'active' : '' }}"
                                   href="{{route('owner.services')}}">
                                    Moji servisi
                                </a>
                            </li>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('service.pending') ? 'active' : '' }}"
                                   href="{{route('service.pending')}}">
                                    Servisi na cekanju
                                </a>
                            </li>
                    @endif
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('booking.my') ? 'active' : '' }}"
                               href="{{route('booking.my')}}">
                                Rezervacije
                            </a>
                        </li>
                @endauth
            </ul>

            <!-- Right dropdown (user menu) -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">{{ Auth::user()->name }}</span>
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Odjavi se</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Prijava</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registracija</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
