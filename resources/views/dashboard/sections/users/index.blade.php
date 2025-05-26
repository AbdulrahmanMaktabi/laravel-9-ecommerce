@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">

                <h3 class="card-title">Users List</h3>



            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <form action="{{ URL::current() }}" method="get" class="row g-2 align-items-end mb-4 mt-2 px-2">
                    <div class="col-md-2">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                            value="{{ request('name') ?? '' }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="title" id="email" class="form-control" placeholder="Enter Email"
                            value="{{ request('email') ?? '' }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone"
                            value="{{ request('phone') ?? '' }}">
                    </div>
                    <div class="col-md-2">
                        <label for="date">Last active</label>
                        <input type="date" name="last_active" id="date" class="form-control"
                            placeholder="Select Date" value="{{ request('last_active') ?? '' }}">
                    </div>
                    <div class="col-md-2">
                        <select name="2fa_status" id="2fa_status" class="form-select">
                            <option value="">2FA Status</option>
                            <option value="active" @selected(request('2fa_status') == 'active')>Active</option>
                            <option value="inactive" @selected(request('2fa_status') == 'inactive')>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>

                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>2FA Status</th>
                            <th>Last Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'no phone' }}</td>
                                <td>{{ (bool) $user->two_factor_secret ? 'yes' : 'no' }}</td>
                                <td>{{ $user->last_active ? \Carbon\Carbon::parse($user->last_active)->diffForHumans(now()) : 'no last active' }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-warning btn-sm">Show</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger btn-sm" style="border-radius:0;"
                                                value="Delete" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No User Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="container pt-4">
                    {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        {{-- Notifications --}}
        <x-dashboard.notyf-alert session="success" />
        <x-dashboard.notyf-alert session="error" />
    </div>
@endsection
