@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Role</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Create Category</div>
            </div>

            <x-dashboard.role.role-form method="POST" route="store" :role="null" :abilites="null" />

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
