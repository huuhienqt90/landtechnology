@component('mail::message')
# Product Hunting

<h3>Thank for your hunting product. We will process your order with in 24 hours.</h3>

@component('mail::button', ['url' => 'http://landtechnology.thinkbest4you.com', 'color' => 'blue'])
View Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent