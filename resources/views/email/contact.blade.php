@component('mail::message')
# Introduction

{{isset($args['content'])?$args['content']:''}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
