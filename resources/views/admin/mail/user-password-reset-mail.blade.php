@component('mail::message')
{{ $data['title'] }}

{{ $data['body'] }}
{{ $data['password'] }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
