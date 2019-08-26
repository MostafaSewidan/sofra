@component('mail::message')
# Introduction

the reset password is <span style="color: blue;">{{$code}}</span>
    <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
