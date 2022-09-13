@component('mail::message')
# Introduction

Ваш пароль: {{ $password }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
