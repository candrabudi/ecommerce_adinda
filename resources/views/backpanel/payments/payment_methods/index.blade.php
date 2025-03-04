@extends('backpanel.layouts.app')

@section('content')
    <div class="app-ecommerce-category">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <input type="text" class="form-control" id="searchPaymentMethod" placeholder="Search Payment Methods...">
            </div>
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addPaymentMethodModal">
                Add Payment Method
            </button>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-payment-methods-list table border-top">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentMethods as $paymentMethod)
                            <tr>
                                <td>{{ $paymentMethod->name }}</td>
                                <td>{{ $paymentMethod->code }}</td>
                                <td>{{ $paymentMethod->type }}</td>
                                <td>{{ $paymentMethod->created_at }}</td>
                                <td>{{ $paymentMethod->updated_at }}</td>
                                <td>
                                    {{-- Edit Button --}}
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editPaymentMethodModal{{ $paymentMethod->id }}">Edit</button>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('payment_methods.destroy', $paymentMethod->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Payment Method Modal --}}
                            <div class="modal fade" id="editPaymentMethodModal{{ $paymentMethod->id }}" tabindex="-1"
                                aria-labelledby="editPaymentMethodModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('payment_methods.update', $paymentMethod->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPaymentMethodModalLabel">Edit Payment Method</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $paymentMethod->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="code" class="form-label">Code</label>
                                                    <input type="text" name="code" class="form-control"
                                                        value="{{ $paymentMethod->code }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select name="type" class="form-select" required>
                                                        <option value="bank" {{ $paymentMethod->type == 'bank' ? 'selected' : '' }}>Bank</option>
                                                        <option value="ewallet" {{ $paymentMethod->type == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                                                    </select>
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

        {{-- Add Payment Method Modal --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="addPaymentMethodModal"
            aria-labelledby="addPaymentMethodModalLabel">
            <div class="offcanvas-header py-6">
                <h5 id="addPaymentMethodModalLabel" class="offcanvas-title">Add Payment Method</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body border-top">
                <form action="{{ route('payment_methods.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPaymentMethodModalLabel">Add New Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                                <option value="bank">Bank</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Payment Method</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
