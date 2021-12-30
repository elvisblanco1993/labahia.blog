@component('mail::message')
# Welcome to La Bahia, {{$name}}!

{{__("Please find your account information below:")}}

**Email**: {{$email}}

**Password**: {{$password}}

{{-- @component('mail::button', ['url' => ''])

@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
