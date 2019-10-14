@component('mail::message')
# Order Review

<h3>Hello, {{ $writer->fname }}</h3>

<p>
    We have noticed that the order: <u><em>{{ $order->title }}</em></u>, that you were working on has some issues. <br>
    The owner would like you to make the appropriate changes as soon as possible. <br>
    For more details, you will communicate with <i>{{ $admin->fname }}</i> 
</p>

<i>Together, we prosper</i>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
