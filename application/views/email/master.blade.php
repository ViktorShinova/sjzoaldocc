@include('email.header')

{{Formatter::strip_tags($email_body)}}

@include('email.footer')
