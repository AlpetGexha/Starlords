<ul class="mt-6">
    <li class="relative px-6 py-3">
        <x-admin.nav-link icone='fa-solid fa-gauge' href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
            {{ __('Dashboard') }}
        </x-admin.nav-link>
    </li>

    @can('user_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-user' href="{{ route('admin.user') }}" :active="request()->routeIs('admin.user')">
                {{ __('Users') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('user_make_role')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-user-tag' href="{{ route('admin.role') }}" :active="request()->routeIs('admin.role')">
                {{ __('Role') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('team_access')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-users' href="{{ route('admin.team.show') }}" :active="request()->routeIs('admin.team.show')">
                {{ __('Staff') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('admin_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-building' href="{{ route('admin.profile') }}" :active="request()->routeIs('admin.profile')">
                {{ __('Organization') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('blog_access')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-blog' href="{{ route('admin.blog.show') }}" :active="request()->routeIs('admin.blog.show')">
                {{ __('Blog') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('category_access')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-tags' href="{{ route('admin.category.show') }}" :active="request()->routeIs('admin.category.show')">
                {{ __('Categorys') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('admin_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-handshake' href="{{ route('admin.sponzor') }}" :active="request()->routeIs('admin.sponzor')">
                {{ __('Partnerships') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('contact_access')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-envelope' href="{{ route('admin.contact.show') }}" :active="request()->routeIs('admin.contact.show')">
                {{ __('Contact') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can(['contact_access', 'admin_show'])
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone='fa-solid fa-circle-info' href="{{ route('admin.feedback.show') }}" :active="request()->routeIs('admin.feedback.show')">
                {{ __('Feedback') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('admin_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone="fa-sharp fa-solid fa-flag" href="{{ route('admin.report') }}" :active="request()->routeIs('admin.report')">
                {{ __('Reports') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('audits_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone="fa-solid fa-file" href="{{ route('admin.audit') }}" :active="request()->routeIs('admin.audit')">
                {{ __('Audits') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('admin_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone="fa-solid fa-toolbox" href="{{ route('admin.backup') }}" :active="request()->routeIs('admin.backup')">
                {{ __('Backup') }}
            </x-admin.nav-link>
        </li>
    @endcan

    @can('admin_show')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone="fa-solid fa-heart" href="{{ route('admin.health') }}" :active="request()->routeIs('admin.health')">
                {{ __('Health') }}
            </x-admin.nav-link>
        </li>
    @endcan


    @can('settings_access')
        <li class="relative px-6 py-3">
            <x-admin.nav-link icone="fa-solid fa-gear" href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">
                {{ __('Settings') }}
            </x-admin.nav-link>
        </li>
    @endcan

    {{-- Get all route who have name crud. --}}
    @forelse (Route::getRoutes()->getRoutesByName() as $route)
        @if (Str::contains($route->getName(), 'admin.crud'))
            <li class="relative px-6 py-3">
                <x-admin.nav-link href="{{ route($route->getName()) }}" :active="request()->routeIs($route->getName())">
                    {{ Str::title(Str::replaceFirst('crud.', '', $route->getName())) }}
                </x-admin.nav-link>
            </li>
        @endif
    @empty
    @endforelse

    <li class="relative px-6 py-3">
        <x-admin.nav-link icone='fa-solid fa-door-open' href="{{ route('homepage') }}" :active="request()->routeIs('homepage')">
            {{ __('Homepage') }}
        </x-admin.nav-link>
    </li>
</ul>
