@extends('backpanel.layouts.app')

@section('content')
    <div class="app-ecommerce-category">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <input type="text" class="form-control" id="searchCategory" placeholder="Search banners...">
            </div>
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addBannerModal">
                Add Banner
            </button>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-category-list table border-top">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td><img src="{{ asset('storage/' . $banner->image_path) }}" width="100"></td>
                                <td>{{ $banner->name }}</td>
                                <td>{{ $banner->description }}</td>
                                <td>{{ $banner->created_at }}</td>
                                <td>{{ $banner->updated_at }}</td>
                                <td>
                                    {{-- Edit Button --}}
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editBannerModal{{ $banner->id }}">Edit</button>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('banners.delete', $banner->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Banner Modal --}}
                            <div class="modal fade" id="editBannerModal{{ $banner->id }}" tabindex="-1"
                                aria-labelledby="editBannerModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('banners.edit', $banner->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBannerModalLabel">Edit Banner</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $banner->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" required>{{ $banner->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <img src="{{ asset('storage/' . $banner->image_path) }}" width="100"
                                                        class="mt-2">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
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

        <div class="offcanvas offcanvas-end" tabindex="-1" id="addBannerModal"
            aria-labelledby="addBannerModalLabel">
            <div class="offcanvas-header py-6">
                <h5 id="addBannerModalLabel" class="offcanvas-title">Add Category</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body border-top">
                <form action="{{ route('banners.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBannerModalLabel">Add New Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Banner</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
