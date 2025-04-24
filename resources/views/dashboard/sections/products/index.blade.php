@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Products List</h3>
                <div class="card-tools">
                    <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <form action="{{ URL::current() }}" method="get" class="row g-2 align-items-end mb-4 mt-2 px-2">
                    <div class="col-md-6">
                        <input type="text" name="title" id="name" class="form-control" placeholder="Enter Title"
                            value="{{ request('title') ?? '' }}">
                    </div>

                    <div class="col-md-5">
                        <select name="status" id="status" class="form-select">
                            <option value="">All</option>
                            <option value="active" @selected(request('status') == 'active')>Active</option>
                            <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Store</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->store?->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category?->name }}</td>
                                <td>
                                    @switch($product->category?->status)
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
                                        <a href="{{ route('categories.edit', $product->category) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('categories.destroy', $product->category) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger btn-sm" style="border-radius:0;"
                                                value="Delete" />
                                        </form>
                                        <form action="{{ route('categories.updateStatusToArchived', $product->category) }}"
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
                                    <td colspan="3"> No Product Found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div class="container pt-4">
                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}

                    </div>

                </div>
                <!-- /.card-body -->
            </div>

            {{-- Notifications --}}
            <x-dashboard.notyf-alert session="success" />
            <x-dashboard.notyf-alert session="error" />
        @endsection
