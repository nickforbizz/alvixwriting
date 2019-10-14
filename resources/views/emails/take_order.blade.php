@component('mail::message')
# Order Has been Assigned


<h4> Hello,  {{ $order->admin()->first()->fnmae }} </h4><br>

We want to notify you that {{ $writer->email }} is now working on the order <br>
<pre>
<b>Order:</b> <u>Title</u> <i>{{ $order->title }}; </i><br>
              <u>Description</u>  <i>{{ $order->description }} </i>;
</pre>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
