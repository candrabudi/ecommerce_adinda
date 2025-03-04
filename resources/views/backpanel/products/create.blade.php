@extends('backpanel.layouts.app')

@section('content')
<div class="container">
    <h2>Create Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea name="short_description" class="form-control" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="long_description" class="form-label">Long Description</label>
                <textarea name="long_description" class="form-control" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            <div class="col">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" name="discount" class="form-control" step="0.01">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="col">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Kategori Produk -->
        <div class="row mb-3">
            <div class="col">
                <label for="categories" class="form-label">Categories</label>
                <select name="categories[]" class="form-control" multiple required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Multiple Image Input -->
        <div class="row mb-3">
            <div class="col">
                <label for="images" class="form-label">Product Images</label>
                <div id="imageInputContainer">
                    <div class="input-group mb-2">
                        <input type="file" name="images[]" class="form-control" required>
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
                <input type="file" name="images[]" class="form-control" required>
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
