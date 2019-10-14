@component('mail::message')
Hello {{ $this->email }},

We've noticed your want to reset your password,
use the link below to get a new password.


@component('mail::button', route('admin.password.reset', ['token' => $this->token, 'email'=> $this->email], false) ) 
Reset Passwd
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
