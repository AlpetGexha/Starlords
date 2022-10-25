@component('mail::message')
    {{ $body }}
    @component('mail::button', ['url' => config('app.url')])
        Go to Website
    @endcomponent

    Thanks, <br>
    {{ config('app.name') }}
@endcomponent
