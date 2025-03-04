@extends('backpanel.layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Product</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" required>{{ $product->short_description }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="long_description" class="form-label">Long Description</label>
                    <textarea name="long_description" class="form-control" required>{{ $product->long_description }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}"
                        required>
                </div>
                <div class="col">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" name="discount" class="form-control" step="0.01"
                        value="{{ $product->discount }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
                <div class="col">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Kategori Produk -->
            <div class="row mb-3">
                <div class="col">
                    <label for="categories" class="form-label">Categories</label>
                    <select name="categories[]" class="form-control" multiple required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Gambar Lama -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Current Product Images</label>
                    <div class="mb-3">
                        @foreach ($product->images as $image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" width="150px"
                                    class="mb-2">
                                <div>
                                    <label>
                                        <input type="checkbox" name="delete_old_images[]" value="{{ $image->id }}">
                                        Delete this image
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Multiple Image Input -->
            <div class="row mb-3">
                <div class="col">
                    <label for="images" class="form-label">Product Images</label>
                    <div id="imageInputContainer">
                        <div class="input-group mb-2">
                            <input type="file" name="images[]" class="form-control">
                            <button type="button" class="btn btn-danger remove-image-input">Remove</button>
                        </div>
                    </div>
                    <button type="button" id="addImageInput" class="btn btn-primary">Add More Images</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInputContainer = document.getElementById('imageInputContainer');
            const addImageInput = document.getElementById('addImageInput');

            addImageInput.addEventListener('click', function() {
                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group', 'mb-2');
                newInputGroup.innerHTML = `
                <input type="file" name="images[]" class="form-control">
                <button type="button" class="btn btn-danger remove-image-input">Remove</button>
            `;
                imageInputContainer.appendChild(newInputGroup);
            });

            imageInputContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-image-input')) {
                    event.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
