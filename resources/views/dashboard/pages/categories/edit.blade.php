@extends('dashboard.layouts.layout')

@section('content')
    <div class="container pt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $category->name }}</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit {{ $category->name }}</div>
            </div>

            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $category->name) }}" required />
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Parent Category -->
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-select">
                            <option value="">-- No Parent (Main Category) --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" name="image" id="image" class="form-control" />
                        @error('image')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="editor" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-- No Status --</option>
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                            <option value="archived">archived</option>
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
            </form>
        </div>

    </div>
@endsection
