@extends('backpanel.layouts.app')

@section('content')
    <div class="container">
        <h3>Payment Accounts</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h4>Add Payment Account</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('payment_accounts.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_method_id" class="form-label">Payment Method</label>
                        <select name="payment_method_id" class="form-control" required>
                            @foreach (\App\Models\PaymentMethod::all() as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Account Name</label>
                        <input type="text" name="account_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" name="account_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_status" class="form-label">Account Status</label>
                        <select name="account_status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Account</button>
                </form>
            </div>
        </div>

        <!-- Payment Accounts Table -->
        <div class="card">
            <div class="card-header">
                <h4>Existing Payment Accounts</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Payment Method</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->paymentMethod->name }}</td>
                                <td>{{ $account->account_name }}</td>
                                <td>{{ $account->account_number }}</td>
                                <td>{{ $account->account_status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editAccountModal{{ $account->id }}">Edit</button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('payment_accounts.destroy', $account->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Account Modal -->
                            <div class="modal fade" id="editAccountModal{{ $account->id }}" tabindex="-1"
                                aria-labelledby="editAccountModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('payment_accounts.update', $account->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAccountModalLabel">Edit Payment Account</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="payment_method_id" class="form-label">Payment Method</label>
                                                    <select name="payment_method_id" class="form-control" required>
                                                        @foreach (\App\Models\PaymentMethod::all() as $method)
                                                            <option value="{{ $method->id }}"
                                                                {{ $method->id == $account->payment_method_id ? 'selected' : '' }}>
                                                                {{ $method->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="account_name" class="form-label">Account Name</label>
                                                    <input type="text" name="account_name" class="form-control"
                                                        value="{{ $account->account_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" name="account_number" class="form-control"
                                                        value="{{ $account->account_number }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="account_status" class="form-label">Account Status</label>
                                                    <select name="account_status" class="form-control" required>
                                                        <option value="1" {{ $account->account_status == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option value="0" {{ $account->account_status == 0 ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
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
    </div>
@endsection
