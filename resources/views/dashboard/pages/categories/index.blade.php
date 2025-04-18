@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Categories List</h3>
                <div class="card-tools">
                    <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm">create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%">#</th>
                            <th style="width: 40%">Name</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <span class="badge text-bg-primary">
                                        {{ $category->parent ? $category->parent->name : 'None' }}
                                    </span>
                                </td>
                                <td>
                                    @switch($category->status)
                                        @case('active')
                                            <span class="badge text-bg-success">active</span>
                                        @break

                                        @case('inactive')
                                            <span class="badge text-bg-danger">inactive</span>
                                        @break

                                        @case('archived')
                                            <span class="badge text-bg-warning">archived</span>
                                        @break

                                        @default
                                            <span class="badge text-bg-secondary">unknown</span>
                                    @endswitch
                                </td>


                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger btn-sm" style="border-radius:0;"
                                                value="Delete" />
                                        </form>
                                        <form action="{{ route('categories.updateStatusToArchived', $category) }}"
                                            method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="submit" class="btn btn-warning btn-sm"
                                                style="border-top-left-radius:0;border-bottom-left-radius:0;"
                                                value="Archive" />
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3"> No Category Found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div class="container pt-4">
                        {{ $categories->links('pagination::bootstrap-5') }}

                    </div>

                </div>
                <!-- /.card-body -->
            </div>
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
