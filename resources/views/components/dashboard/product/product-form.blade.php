<form action="{{ route('products.' . $route, $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <input type="hidden" name="store" value="{{ Auth::user()->store?->first()?->slug ?? 'no store' }}">
    <div class="card-body">
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Product Title</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $product->title) }}" required />
            @error('title')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Product Category -->
        <div class="mb-3">
            <label for="category" class="form-label">Product Category</label>
            <select name="category" id="category" class="form-select">
                <option value="">-- No Category --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected($product->category?->id == $cat->id)>{{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
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

        <!-- Small Description -->
        <div class="mb-3">
            <label for="small_description" class="form-label">Small Description</label>
            <input type="text" name="small_description" id="small_description"
                value="{{ old('description', $product->description) }}" class="form-control" />
            @error('small_description')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="editor" name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <div class="d-flex justify-content-around mb-3">
                <div class="col-lg-6 pe-2">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="text" name="price" id="price" class="form-control">
                    @error('price')
                        <div class="invalid-feddback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-lg-6 ps-2">
                    <label for="compare_price" class="form-label">Product Compare Price</label>
                    <input type="text" name="compare_price" id="compare_price" class="form-control">
                    @error('compare_price')
                        <div class="invalid-feddback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">-- No Status --</option>
                <option @selected($product->status == 'active') value="active">active</option>
                <option @selected($product->status == 'inactive') value="inactive">inactive
                </option>
                <option @selected($product->status == 'archived') value="archived">archived
                </option>
                <option @selected($product->status == 'draft') value="draft">draft
                </option>
            </select>
            @error('status')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Featured -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="featured">
                <label class="form-check-label user-select-none" for="featured">
                    Featured
                </label>
            </div>
            @error('featured')
                <div class="invalid-feddback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- SEO -->
        <div class="mb-3">
            <div class="d-flex justify-content-around mb-3">
                <div class="col-lg-6 pe-2">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control">
                    @error('meta_title')
                        <div class="invalid-feddback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-lg-6 ps-2">
                    <label for="meta_links	" class="form-label">Meta Links</label>
                    <input type="text" name="meta_links	" id="meta_links	" class="form-control">
                    @error('meta_links ')
                        <div class="invalid-feddback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="col-lg-12">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea id="editor" name="meta_description">{{ old('meta_description', $product->meta_description) }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </div>
</form>
