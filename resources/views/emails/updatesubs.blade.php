@component('mail::message')
 Hello There

Am interested in receiving your news and updates as from today.

________________________________________________________________________
@component('mail::button', ['url' => 'Admin\approveSubs\{{ $email }}'])
Approve
@endcomponent

Regards,<br>
{{ $email }} <br>
{{ config('app.name') }}
@endcomponent
