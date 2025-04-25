@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Trashed Products</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Trashed Products List</h3>
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
                            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
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
                                    @switch($product?->status)
                                        @case('active')
                                            <span class="badge text-bg-success">active</span>
                                        @break

                                        @case('inactive')
                                            <span class="badge text-bg-danger">inactive</span>
                                        @break

                                        @case('archived')
                                            <span class="badge text-bg-warning">archived</span>
                                        @break

                                        @case('draft')
                                            <span class="badge text-bg-warning">draft</span>
                                        @break

                                        @default
                                            <span class="badge text-bg-secondary">unknown</span>
                                    @endswitch
                                </td>


                                <td>
                                    <div class="btn-group" role="group">

                                        <form action="{{ route('products.forceDelete', $product) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger btn-sm"
                                                style="border-top-right-radius:0;border-bottom-right-radius:0;"
                                                value="Force" />
                                        </form>
                                        <form action="{{ route('products.restore', $product) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="submit" class="btn btn-success btn-sm"
                                                style="border-top-left-radius:0;border-bottom-left-radius:0;"
                                                value="Restore" />
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3"> No Trashed Product Found
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
