@component('mail::message')

Hi!<br>

Code your verification is {{ $confirm_code }}

Please enter the code to activate and login into your account....

Thanks,<br>
{{ config('app.name') }}
@endcomponent
