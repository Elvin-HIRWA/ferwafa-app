@component('mail::message')
Hello **{{$name}}**, {{-- use double space for line break --}}
Follow the guide to signup to Ferwafa Website !

Click below to start Sign up
@component('mail::button', ['url' => $link])
click to redirect
@endcomponent
Sincerely,
Ferwafa team.
@endcomponent