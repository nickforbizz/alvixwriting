@component('mail::message')
# Order Review

<h3>Hello, {{ $writer->fname }}</h3>

<p>
    Congrats on successfull completion of the order: <u><em>{{ $order->title }}</em></u>, that you were working on. <br>
    The owner has accepted your work. <br>
    Just wait a bit as we process your payment. <br>
    For more details, you will communicate with <i>{{ $admin->fname }}</i> 
</p>

<i>Together, we prosper</i>

Thanks,<br>
{{ config('app.name') }}
@endcomponent