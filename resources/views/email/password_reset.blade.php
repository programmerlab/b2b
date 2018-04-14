Click here to reset your password:
<a href="{{ $link = url('auth/password/reset').'?email='.urlencode($user->getEmailForPasswordReset()).'&token='.$token }}">
    {{ $link }}
</a>