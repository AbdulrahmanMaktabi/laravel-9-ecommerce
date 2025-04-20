<form action="{{ route('categories.' . $route, $category) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
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
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($cat->id == $category->parent?->id)>{{ $cat->name }}
                    </option>
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
            <span @class([
                'text-uppercase',
                'text-danger',
                'd-none' => $method != 'PUT',
            ])>
                if u dont upload new image the old image will
            </span>
            @error('image')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="editor" name="description">{{ old('description', $category->description) }}</textarea>
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
                <option @selected($category->status == 'active') value="active">active</option>
                <option @selected($category->status == 'inactive') value="inactive">inactive
                </option>
                <option @selected($category->status == 'archived') value="archived">archived
                </option>
            </select>
            @error('parent_id')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </div>
</form>
