@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Roles List</h3>
                <div class="card-tools">
                    <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm">create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">


                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%">#</th>
                            <th style="width: 60%">Name</th>
                            <th style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>




                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST">
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
                                <td colspan="3"> No Role Found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
                <div class="container pt-4">
                    {{ $roles->withQueryString()->links('pagination::bootstrap-5') }}

                </div>

            </div>
            <!-- /.card-body -->
        </div>

        {{-- Notifications --}}
        <x-dashboard.notyf-alert session="success" />
        <x-dashboard.notyf-alert session="error" />
    @endsection
