@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $category->name }}</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit {{ $category->name }}</div>
            </div>

            <x-dashboard.category.category-form :category="$category" :categories="$categories" method="PUT" route="update"
                button="Update" />
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
