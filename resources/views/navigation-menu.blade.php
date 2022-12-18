<nav x-data="{ open: false, transprent: false, showBar: false }" class="navbar backdrop-blur bg-white sticky top-0 border-bottom shadow-lg py-4 z-50"
    {{-- :class="showBar ? 'py-2' : 'py-4'" @scroll.window="showBar = (window.pageYOffset => 20) ? true : false"  --}} {{-- x-transition --}}>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex"
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('homepage') }}" class="cursor-pointer">
                        <h3 class="text-2xl font-medium text-cyan-500">
                            <img class="h-12 w-150 object-cover" src="{{ url('/images/Logo_svg.svg') }}"
                                alt="{{ env('APP_ENV' . 'Logo') }}">
                        </h3>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 nav:-my-px nav:ml-10 nav:flex whitespace-nowrap uppercase">
                    <x-jet-nav-link href="{{ route('homepage') }}" :active="request()->routeIs('homepage')"
                        class="flex text-gray-900 hover:text-cyan-500
                    cursor-pointer transition-colors duration-300">
                        {{ __('Home') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')"
                        class="flex text-gray-900 hover:text-cyan-500 cursor-pointer transition-colors duration-300">
                        {{ __('About Us') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')"
                        class="flex text-gray-900 hover:text-cyan-500
                    cursor-pointer transition-colors duration-300">
                        {{ __('Contact Us') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('blog') }}" :active="request()->routeIs('blog')"
                        class="flex text-gray-900 hover:text-cyan-500
                    cursor-pointer transition-colors duration-300">
                        {{ __('Blog') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('event.show') }}" :active="request()->routeIs('event.show')"
                        class="flex text-gray-900 hover:text-cyan-500
                    cursor-pointer transition-colors duration-300">
                        {{ __('Events') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('profile.all') }}" :active="request()->routeIs('profile.all')"
                        class="flex text-gray-900 hover:text-cyan-500
                    cursor-pointer transition-colors duration-300">
                        {{ __('Organizations') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden nav:flex nav:items-center nav:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 active:bg-gray-50 transition">
                                        @auth
                                            {{ Auth::user()->currentTeam->name }}
                                        @endauth
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    @auth
                                        <x-jet-dropdown-link
                                            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-jet-dropdown-link>
                                    @endauth

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <button @click="$dispatch('toggle-spotlight')"
                    class="inline-flex ml-1 items-center px-1 pt-1 border-b-2 border-transparent text-sm whitespace-nowrap uppercase leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition space-x-2">
                    <i class="fa-solid fa-magnifying-glass"></i><span class="tracking-tighter"></span>
                    &nbsp;
                </button>

                <!-- Settings Dropdown -->
                @guest
                    <div class="flex items-center space-x-5">
                        <a href="{{ route('register') }} "
                            class="flex text-gray-900 hover:text-cyan-500
                    cursor-pointer transition-colors duration-300">

                            <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 0L11.34 .03L15.15 3.84L16.5 2.5C19.75 4.07 22.09 7.24 22.45 11H23.95C23.44 4.84 18.29 0 12 0M12 4C10.07 4 8.5 5.57 8.5 7.5C8.5 9.43 10.07 11 12 11C13.93 11 15.5 9.43 15.5 7.5C15.5 5.57 13.93 4 12 4M12 6C12.83 6 13.5 6.67 13.5 7.5C13.5 8.33 12.83 9 12 9C11.17 9 10.5 8.33 10.5 7.5C10.5 6.67 11.17 6 12 6M.05 13C.56 19.16 5.71 24 12 24L12.66 23.97L8.85 20.16L7.5 21.5C4.25 19.94 1.91 16.76 1.55 13H.05M12 13C8.13 13 5 14.57 5 16.5V18H19V16.5C19 14.57 15.87 13 12 13M12 15C14.11 15 15.61 15.53 16.39 16H7.61C8.39 15.53 9.89 15 12 15Z" />
                            </svg>

                            Register
                        </a>


                        <a href="{{ route('login') }} "
                            class="flex text-gray-900
                    cursor-pointer transition-colors duration-300
                    font-semibold text-cyan-600">

                            <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                            </svg>

                            Login
                        </a>
                    </div>
                @endguest

                <div class="ml-3 relative">
                    @auth
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <span
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition"
                                            :class="transprent && 'bg-white'">
                                            {{ Auth::user()->username() }}
                                        </span>
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->username() }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 transition">
                                            {{ Auth::user()->username() }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                @can('admin_show')
                                    <x-jet-dropdown-link href="{{ route('admin.dashboard') }}">
                                        {{ __('Admin Panel') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                @auth
                                    <x-jet-dropdown-link
                                        href="{{ route('profile.user.single', ['username' => Auth::user()->username()]) }}">
                                        {{ __('My Profile') }}
                                    </x-jet-dropdown-link>
                                @endauth

                                @auth
                                    <x-jet-dropdown-link href="{{ route('event.myticket') }}">
                                        {{ __('My Ticket') }}
                                    </x-jet-dropdown-link>
                                @endauth

                                @auth
                                    <x-jet-dropdown-link href="{{ route('profile.organization') }}">
                                        {{ __('My Organization') }}
                                    </x-jet-dropdown-link>
                                @endauth

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Settings') }}
                                </x-jet-dropdown-link>

                                @auth
                                    <x-jet-dropdown-link href="{{ route('profile.create') }}">
                                        {{ __('Create Organization') }}
                                    </x-jet-dropdown-link>
                                @endauth

                                @auth
                                    <x-jet-dropdown-link href="{{ route('event.create') }}">
                                        {{ __('Create Event') }}
                                    </x-jet-dropdown-link>
                                @endauth

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center nav:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden nav:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-jet-responsive-nav-link href="{{ route('homepage') }}" :active="request()->routeIs('homepage')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')">
                {{ __('About Us') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                {{ __('Contact Us') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                {{ __('Blog') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('event.show') }}" :active="request()->routeIs('event.show')">
                {{ __('Events') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('profile.all') }}" :active="request()->routeIs('profile.all')">
                {{ __('Organizations') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @auth
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->username() }}" />
                        </div>
                    @endif
                @endauth

                @auth
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->username() }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @can('admin_show')
                    <x-jet-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Panel') }}
                    </x-jet-responsive-nav-link>
                @endcan

                @auth
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('My Profile') }}
                    </x-jet-responsive-nav-link>
                @endauth

                <!-- Account Management -->
                @auth
                    <x-jet-responsive-nav-link href="{{ route('event.myticket') }}" :active="request()->routeIs('event.myticket')">
                        {{ __('My Ticket') }}
                    </x-jet-responsive-nav-link>
                @endauth

                @auth
                    <x-jet-responsive-nav-link href="{{ route('profile.user.single', ['username' => Auth::user()->username()]) }}" :active="request()->routeIs('profile.user.single', ['username' => Auth::user()->username()])">
                        {{ __('Settings') }}
                    </x-jet-responsive-nav-link>
                @endauth

                @auth
                    <x-jet-responsive-nav-link href="{{ route('profile.create') }}" :active="request()->routeIs('profile.create')">
                        {{ __('Create Organization') }}
                    </x-jet-responsive-nav-link>
                @endauth

                @auth
                    <x-jet-responsive-nav-link href="{{ route('event.create') }}" :active="request()->routeIs('event.create')">
                        {{ __('Create Event') }}
                    </x-jet-responsive-nav-link>
                @endauth

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                @auth
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-jet-responsive-nav-link>
                    </form>
                @else
                    @if (Route::has('login'))
                        <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Log In') }}
                        </x-jet-responsive-nav-link>
                    @endif

                    @if (Route::has('register'))
                        <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-jet-responsive-nav-link>
                    @endif

                @endauth
                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @auth
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                        @endforeach
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>
