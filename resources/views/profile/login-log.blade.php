<x-jet-action-section>
    <x-slot name="title">
        {{ __('Login Action') }}
    </x-slot>

    <x-slot name="description">
        {{ __('This show you details about your Login Action') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('This you Last 5 Login Info') }}
        </div>

        {{-- {{ auth()->user()->authentications->last() }} --}}
        @forelse (auth()->user()->authentications()->limit(5)->get() as $auth)
            <div class="mt-3 ml-5 text-sm text-gray-600">
                <p> <i>Login: </i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $auth->login_at }}</b> </p>
                <p> <i>Logout: </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>              {{ $auth->logout_at }}</b> </p>
                <p> <i>Ip Address: </i>&nbsp; <b>                                                   {{ $auth->ip_address }}</b> </p>
                <p> <i>User Agent: </i>&nbsp; <b>                                                   {{ $auth->user_agent }}</b> </p>

                <p> <i>Location: </i>&nbsp;
               <div class="ml-3">
                    <p><i>Country: </i> <b>{{ geoip()->getLocation($auth->ip)->country }}</b> </p>
                    <p><i>City: </i> <b>{{ geoip()->getLocation($auth->ip)->city }}</b> </p>
                    <p><i>Timezone: </i> <b>{{ geoip()->getLocation($auth->ip)->timezone }}</b> </p>
                    {{-- <a href="https://www.latlong.net/c/?lat={{ $auth->lat }}&long={{ $auth->lon }}"target="_blank">Click the Map</a> --}}
               </div>
            </div>
        @empty
            <div class="mt-3 ml-5 text-sm text-gray-600">
                {{ __('No Login Action Found') }}
            </div>
        @endforelse
        {{-- {{ auth()->user()->lastLoginAt() }} --}}
        {{-- {{ auth()->user()->lastSuccessfulLoginAt(); }} --}}
        {{-- {{ auth()->user()->lastLoginIp() }} --}}
        {{-- {{ auth()->user()->lastSuccessfulLoginIp(); }} --}}
        {{-- {{ auth()->user()->previousLoginAt(); }} --}}
        {{-- {{ auth()->user()->previousLoginIp(); }} --}}
        {{-- <p>Last Login:{{ auth()->user()->lastLoginAt() }} / {{ auth()->user()->previousLoginIp() }} </p> --}}

    </x-slot>
</x-jet-action-section>
