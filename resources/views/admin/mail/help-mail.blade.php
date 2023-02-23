@component('mail::message')
# Introduction

{{ $body['msg'] }}


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
