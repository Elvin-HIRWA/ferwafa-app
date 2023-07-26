@component('mail::message')
**{{$subject}}**, {{-- use double space for line break --}}


{{$content}}
@endcomponent