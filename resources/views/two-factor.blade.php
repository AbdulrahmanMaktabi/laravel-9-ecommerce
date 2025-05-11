<html>

<body>
    <form action="{{ route('two-factor.enable') }}" method="post">
        @csrf
        @if (!$user->two_factor_secret)
            <input type="submit" value="Enable">
            @if (session('status') == 'two-factor-authentication-confirmed')
                <div class="mb-4 font-medium text-sm">
                    Two factor authentication confirmed and enabled successfully.
                </div>
            @endif
            @dd($user)
        @else
            {!! $user->twoFactorQrCodeSvg() !!}
            @method('delete')
            <input type="submit" value="Disable">
        @endif
    </form>

</body>

</html>
