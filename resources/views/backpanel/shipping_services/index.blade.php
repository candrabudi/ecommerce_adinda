@extends('backpanel.layouts.app')

@section('content')
    <div class="app-ecommerce-category">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <input type="text" class="form-control" id="searchService" placeholder="Search shipping services...">
            </div>
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addServiceModal">
                Add Shipping Service
            </button>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-category-list table border-top">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td><img src="{{ asset('storage/' . $service->image) }}" width="100"></td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $service->created_at }}</td>
                                <td>{{ $service->updated_at }}</td>
                                <td>
                                    {{-- Edit Button --}}
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editServiceModal{{ $service->id }}">Edit</button>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('shipping_services.delete', $service->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Service Modal --}}
                            <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1"
                                aria-labelledby="editServiceModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('shipping_services.update', $service->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editServiceModalLabel">Edit Shipping Service
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $service->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1"
                                                            {{ $service->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0"
                                                            {{ $service->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <img src="{{ asset('storage/' . $service->image) }}" width="100"
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

        <div class="offcanvas offcanvas-end" tabindex="-1" id="addServiceModal" aria-labelledby="addServiceModalLabel">
            <div class="offcanvas-header py-6">
                <h5 id="addServiceModalLabel" class="offcanvas-title">Add Shipping Service</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body border-top">
                <form action="{{ route('shipping_services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Add New Shipping Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Shipping Service</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
