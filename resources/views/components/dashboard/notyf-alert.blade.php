@if (session()->has($session))
    @push('scripts')
        <script>
            notyf.success("{{ session($session) }}");
        </script>
    @endpush
@endif
