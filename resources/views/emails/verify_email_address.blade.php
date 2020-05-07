@component('mail::message')
# Verify Your Email Address

@component('mail::panel')

Hi {{ $name }},

To complete your account setup please verify your email address by clicking the button below.

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
