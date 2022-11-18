@component('mail::message')

Hi {{ucfirst($name)}},

Please login with the given credentials, Change your password from your profile.

Email:  {{ $email  }}
<br>
Password: {{ $plain_password  }}
<br><br>
URL: {{$url}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
