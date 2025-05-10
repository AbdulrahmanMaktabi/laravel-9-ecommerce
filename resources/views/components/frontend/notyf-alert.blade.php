@if (session()->has($session))
    <script>
        notyf.{{ $session }}("{{ session($session) }}");
    </script>
@endif
