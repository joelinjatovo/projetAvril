@component('mail::message')
# Introduction

{{$item->filter()}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

<img src="{{route('mail.read', $line)}}" >
Thanks,<br>
{{ config('app.name') }}
@endcomponent
