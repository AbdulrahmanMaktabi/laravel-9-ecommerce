@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Admins</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
            </ol>
        </nav>

        <!-- Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Edit Admin - {{ $admin->name }}</h3>
            </div>

            <div class="card-body">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input readonly type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', $admin->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input readonly type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', $admin->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone">Phone</label>
                        <input readonly type="text" id="phone" name="phone" class="form-control"
                            value="{{ old('phone', $admin->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="active" {{ $admin->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="banned" {{ $admin->status == 'banned' ? 'selected' : '' }}>Banned
                            <option value="inactive" {{ $admin->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="roles">Roles</label>
                        <select readonly id="roles" name="roles[]" class="form-control" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ in_array($role->id, old('roles', $admin->roles->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Hold Ctrl (Cmd on Mac) to select multiple roles.</small>
                    </div>
                </div>

                <span class="text-success">Current role: {{ $admin?->roles?->first()?->name ?? 'none' }}</span>

            </div>
        </div>

        <!-- Notifications -->
        <x-dashboard.notyf-alert session="success" />
        <x-dashboard.notyf-alert session="error" />
    </div>
@endsection
