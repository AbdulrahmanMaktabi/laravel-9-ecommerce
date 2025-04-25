@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Category</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Create Category</div>
            </div>

            <x-dashboard.category.category-form :categories="$categories" method="POST" route="store" />

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

    {{-- Notifications --}}
    <x-dashboard.notyf-alert session="success" />
    <x-dashboard.notyf-alert session="error" />
@endsection
