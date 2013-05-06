@include('email.email-header')

Dear {{$email_to}},
<br/>
<br/>
{{$email_body}}
<br/>
{{$email_from}}

@include('email.email-footer')
