@component('mail::message')
{{ $data['title'] }}

{{ $data['body'] }}

@component('mail::button', ['url' => $data['url']])
    Click to verify your Email
@endcomponent

Thanks,<br>
{{ config('APP_NAME') }}
@endcomponent
