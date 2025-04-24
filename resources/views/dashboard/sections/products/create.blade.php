@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Product</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Create Product</div>
            </div>

            {{-- <x-dashboard.category.category-form :categories="$categories" method="POST" route="store" /> --}}

        </div>

    </div>
    @if ($errors->any())
        @push('scripts')
            <script>
                @foreach ($errors->all() as $error)
                    notyf.error(@json($error));
                @endforeach
            </script>
        @endpush
    @endif

    @if (session()->has('success'))
        @push('scripts')
            <script>
                notyf.success("{{ session('success') }}");
            </script>
        @endpush
    @elseif (session()->has('error'))
        @push('scripts')
            <script>
                notyf.error("{{ session('error') }}");
            </script>
        @endpush
    @endif
@endsection
