@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Users',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [
                    ['name' => 'Users', 'url' => route('users.index')],
                ]
            ])
            @include('components.alerts')

            <!-- Filters Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Filter Users</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('users.index') }}">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="mb-3 mb-lg-0">
                                            <input type="text" 
                                                   name="name" 
                                                   class="form-control" 
                                                   id="nameInput"
                                                   placeholder="Search by name" 
                                                   value="{{ request('name') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="mb-3 mb-lg-0">
                                            <input type="number" 
                                                   name="id" 
                                                   class="form-control" 
                                                   id="idInput"
                                                   placeholder="Search by ID" 
                                                   value="{{ request('id') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="mb-3 mb-lg-0">
                                            <select name="role" class="form-select" id="roleSelect">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" 
                                                            {{ request('role') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="d-flex justify-content-lg-end gap-2">
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                            <a href="{{ route('users.index') }}" 
                                               class="btn btn-outline-secondary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Filters Card -->

            <!-- Users Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Users</h4>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
                                Create User
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->name ?? 'N/A' }}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $user->id }}" 
                                                        data-first_name="{{ $user->first_name }}"
                                                        data-last_name="{{ $user->last_name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-role="{{ $user->role_id }}" 
                                                        data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($users->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center">No users found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-user-first-name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="create-user-first-name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-user-last-name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="create-user-last-name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-user-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="create-user-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-user-role" class="form-label">Role</label>
                            <select class="form-select" id="create-user-role" name="role_id" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="create-user-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="create-user-password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Create User Modal -->

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-user-id" name="id">
                        <div class="mb-3">
                            <label for="edit-user-first-name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit-user-first-name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-user-last-name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit-user-last-name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-user-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-user-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-user-role" class="form-label">Role</label>
                            <select class="form-select" id="edit-user-role" name="role_id" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Optional password update -->
                        <div class="mb-3">
                            <label for="edit-user-password" class="form-label">Password (Leave blank to keep current password)</label>
                            <input type="password" class="form-control" id="edit-user-password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Edit User Modal -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // When an edit button is clicked, retrieve the data attributes and fill the modal form.
            $('.edit-btn').click(function() {
                var userId = $(this).data('id');
                var firstName = $(this).data('first_name');
                var lastName = $(this).data('last_name');
                var email = $(this).data('email');
                var roleId = $(this).data('role');

                // Set the input values in the edit modal.
                $('#edit-user-id').val(userId);
                $('#edit-user-first-name').val(firstName);
                $('#edit-user-last-name').val(lastName);
                $('#edit-user-email').val(email);
                $('#edit-user-role').val(roleId);

                // Update the form action to point to the correct update URL.
                $('#editUserForm').attr('action', '/admin/users/' + userId);
            });
        });
    </script>
@endpush