@component('mail::message')

# Order Submission

<h3>Hello  {{ $admin->fname }},</h3>


<p>
    We want to notify you that <b>{{ $writer->email }} </b> has completed <br>
    working on the order <em>{{ $order->title }}</em> that he/she was working on. <br>
    You may see the order in your account under order reviews.
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
