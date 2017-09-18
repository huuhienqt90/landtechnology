@component('mail::message')
# Accept swap

Product of you had swapped.

@component('mail::button', ['url' => 'http://landtechnology.thinkbest4you.com', 'color' => 'blue'])
View Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
