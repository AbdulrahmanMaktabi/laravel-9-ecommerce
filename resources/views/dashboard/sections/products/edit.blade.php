@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $product->title }}</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit {{ $product->title }}</div>
            </div>

            <x-dashboard.product.product-form :product="$product" :categories="$categories" :stores="$stores" method="PUT"
                route="update" button="Update" />
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
