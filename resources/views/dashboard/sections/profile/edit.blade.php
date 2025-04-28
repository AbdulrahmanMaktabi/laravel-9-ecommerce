@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $user->name }}</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit {{ $user->name }}</div>
            </div>

            <form action="{{ route('profile.update', Auth::user()) }}" method="POST" style="padding:20px">
                @csrf
                @method('patch')

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name"
                            class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name', $user->profile->first_name ?? '') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name"
                            class="form-control @error('last_name') is-invalid @enderror"
                            value="{{ old('last_name', $user->profile->last_name ?? '') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror"
                            required>
                            <option value="">-- Select Gender --</option>
                            <option value="male"
                                {{ old('gender', $user->profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female"
                                {{ old('gender', $user->profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Locale -->
                    <div class="col-md-6 mb-3">
                        <label for="locale" class="form-label">Locale (Language Code)</label>
                        <select name="locale" id="locale" class="form-select @error('locale') is-invalid @enderror"
                            required>
                            @forelse ($locales as $locale)
                                <option value="{{ $locale }}" {{ old('locale', $user->profile->locale ?? '') }}>
                                    {{ $locale }}
                                </option>
                            @empty
                            @endforelse
                        </select>

                        @error('locale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Birthday -->
                    <div class="col-md-6 mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" name="birthday" id="birthday"
                            class="form-control @error('birthday') is-invalid @enderror"
                            value="{{ old('birthday', $user->profile->birthday ?? '') }}" required>
                        @error('birthday')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->profile->phone ?? '') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address"
                            class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', $user->profile->address ?? '') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="col-md-6 mb-3">
                        <label for="country" class="form-label">Country Code</label>
                        <select name="country" id="locale" class="form-select @error('country') is-invalid @enderror"
                            required>
                            @forelse ($countries as $country => $code)
                                <option value="{{ $code }}" {{ old('country', $user->profile->country ?? '') }}>
                                    {{ $country }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" id="city"
                            class="form-control @error('city') is-invalid @enderror"
                            value="{{ old('city', $user->profile->city ?? '') }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Zip Code -->
                    <div class="col-md-6 mb-3">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" name="zip_code" id="zip_code"
                            class="form-control @error('zip_code') is-invalid @enderror"
                            value="{{ old('zip_code', $user->profile->zip_code ?? '') }}" required>
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>

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
