@component('mail::message')

# Thank you!

Thank you for purchasing from our store. Below is your receipt and link to track your shipping.

@component('mail::table')

|Product  |QTY  |Price   |
|---------|-----|--------|
@foreach($cart as $item)
|{{ $item->name }} |{{ $item->qty }}    |   ${{ $item->price }}|
@endforeach
|&nbsp;   |Total|${{ Cart::total() }}|

@endcomponent

@component('mail::button', ['url' => 'http://landtechnology.thinkbest4you.com', 'color' => 'blue'])
View Home
@endcomponent

Regards,
{{ config('app.name') }}

@endcomponent