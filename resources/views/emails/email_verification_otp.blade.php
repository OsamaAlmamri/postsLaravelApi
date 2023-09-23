<!DOCTYPE html>
<html>

<head>
    <title>{{ __('mail.email_verification') }}</title>
</head>

<body>
    <h1>{{ __('mail.email_verification') }}</h1>
    <p>
        {{ __('mail.email_verification_desc', ['code' => $data->otp]) }}
    </p>
</body>

</html>
