@extends('backpanel.layouts.app')

@section('content')
    <div class="app-ecommerce-product">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <input type="text" class="form-control" id="searchProduct" placeholder="Search products...">
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                Add Product
            </a>
        </div>
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-product-list table border-top">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Categories</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @foreach($product->categories as $category)
                                        <span class="badge bg-secondary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>Rp{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->discount ? $product->discount . '%' : 'No discount' }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    @foreach($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->image_path) }}" width="50" alt="Product Image">
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                    <button class="btn btn-danger"
                                        onclick="deleteProduct({{ $product->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
