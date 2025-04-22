@if (session()->has($session))
    @push('scripts')
        <script>
            notyf.{{ $session }}("{{ session($session) }}");
        </script>
    @endpush
@endif
