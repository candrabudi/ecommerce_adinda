@extends('backpanel.layouts.app')

@section('content')
    <div class="app-ecommerce-category">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" id="searchCategory" placeholder="Search categories...">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEcommerceCategoryList">
                Add Category
            </button>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-category-list table border-top">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Categories</th>
                            <th class="text-nowrap text-sm-end">Total Products &nbsp;</th>
                            <th class="text-nowrap text-sm-end">Total Earning</th>
                            <th class="text-lg-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><img src="{{ asset('storage/' . $category->image) }}" width="50" alt="Category Image"></td>
                                <td>{{ $category->name }}</td>
                                <td class="text-end">{{ $category->products->count() }}</td>
                                <td class="text-end">${{ $category->earnings }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteCategory({{ $category->id }})">Delete</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('backpanel.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="category-title">Title</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="category-image">Image</label>
                                                    <input class="form-control" type="file" name="image">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description">{{ $category->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="Scheduled" {{ $category->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                                        <option value="Publish" {{ $category->status == 'Publish' ? 'selected' : '' }}>Publish</option>
                                                        <option value="Inactive" {{ $category->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update Category</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceCategoryList" aria-labelledby="offcanvasEcommerceCategoryListLabel">
            <div class="offcanvas-header py-6">
                <h5 id="offcanvasEcommerceCategoryListLabel" class="offcanvas-title">Add Category</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body border-top">
                <form action="{{ route('backpanel.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name" id="categoryName" placeholder="Enter category name">
                    </div>
                    <div class="mb-3">
                        <label for="categorySlug" class="form-label">Category Slug</label>
                        <input type="text" class="form-control" name="slug" id="categorySlug" placeholder="Enter unique slug">
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="categoryImage">
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="categoryDescription" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoryStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="categoryStatus">
                            <option value="Inactive">Inactive</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Publish">Publish</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categoryParent" class="form-label">Parent Category</label>
                        <select class="form-select" name="parent_id" id="categoryParent">
                            <option value="">None</option>
                            @foreach($categories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
