@component('mail::message')

# Recommed!

Hi, i wanna swap products for you. Please check product swapping of you. <br>
It's note: {{ $note }}. <br>
Thanks!

@component('mail::button', ['url' => 'http://landtechnology.thinkbest4you.com', 'color' => 'blue'])
View Home
@endcomponent

Regards,
{{ config('app.name') }}

@endcomponent