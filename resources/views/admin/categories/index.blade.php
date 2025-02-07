@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title and Create Button -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Profile',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [
                    ['name' => 'Categories', 'url' => route('categories.index')],
                ]
            ])
            @include('components.alerts')
            <!-- Categories Table -->
            <div class="row">
                <div class="col-xl-12">
          
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Categories</h4>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                Create Category
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $category->id }}</th>
                                                <td>{{ $category->name }}</td>
                                                <td class="text-end"> <!-- Align buttons to the right -->
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                        data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                                        Edit
                                                    </button>
                                    
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($categories->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">No categories found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $categories->links() }}
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

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-category-name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="create-category-name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Create Category Modal -->

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <!-- The form's action will be dynamically updated using jQuery -->
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT') <!-- Ensure correct method for updates -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-category-name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="edit-category-name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Edit Category Modal -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // When an edit button is clicked, retrieve the data attributes and fill the modal form.
            $('.edit-btn').click(function() {
                var categoryId = $(this).data('id');
                var categoryName = $(this).data('name');

                // Set the input value in the edit modal.
                $('#edit-category-name').val(categoryName);

                // Update the form action to point to the correct update URL.
                $('#editCategoryForm').attr('action', '/admin/categories/' + categoryId);
            });
        });
    </script>
@endpush
