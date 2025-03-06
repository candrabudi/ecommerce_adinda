@extends('backpanel.layouts.app')

@section('content')
    <div class="app-users-management">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Manage Users</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="input-group w-50">
                        <input type="text" class="form-control" id="searchUser" placeholder="Search users...">
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Add User
                    </button>
                </div>
            </div>
        </div>

        <div class="card">
            
            <div class="card-datatable table-responsive">
                <table class="datatables-user-list table border-top">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editUserModal{{ $user->id }}">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                                </td>
                            </tr>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('backpanel.users.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        value="{{ $user->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ $user->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password (leave blank if not
                                                        changing)</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select class="form-select" name="role" required>
                                                        <option value="admin"
                                                            {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="employee"
                                                            {{ $user->role == 'employee' ? 'selected' : '' }}>Employee
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="is_active" class="form-label">Status</label>
                                                    <select class="form-select" name="is_active" required>
                                                        <option value="1" {{ $user->is_active ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0" {{ !$user->is_active ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update User</button>
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

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('backpanel.users.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="employee">Employee</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_active" class="form-label">Status</label>
                                <select class="form-select" name="is_active" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add User</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                axios.delete(`/backpanel/users/${userId}`)
                    .then(response => {
                        location.reload();
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the user.');
                    });
            }
        }
    </script>
@endsection
