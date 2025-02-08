@extends('dashboard-layouts.app')

@section('content')
    <!-- Bootstrap CSS -->

    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title and Create Button -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Dimensions',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [['name' => 'Dimensions', 'url' => route('dimensions.index')]],
            ])
            @include('components.alerts')

            <!-- Dimensions Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Dimensions</h4>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#createDimensionModal">
                                Create Dimension
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dimension Name</th>
                                            <th>Description</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dimensions as $dimension)
                                            <tr>
                                                <th scope="row">{{ $dimension->id }}</th>
                                                <td>{{ $dimension->name }}</td>
                                                <td>{!! Str::limit(strip_tags($dimension->description), 50) !!}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $dimension->id }}" data-name="{{ $dimension->name }}"
                                                        data-description="{{ $dimension->description }}"
                                                        data-bs-toggle="modal" data-bs-target="#editDimensionModal">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('dimensions.destroy', $dimension->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($dimensions->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">No dimensions found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $dimensions->links() }}
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

    <!-- Create Dimension Modal -->
    <div class="modal fade" id="createDimensionModal" tabindex="-1" aria-labelledby="createDimensionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('dimensions.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createDimensionModalLabel">Create Dimension</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-dimension-name" class="form-label">Dimension Name</label>
                            <input type="text" class="form-control" id="create-dimension-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-dimension-description" class="form-label">Description</label>
                            <textarea class="form-control" id="create-dimension-description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create Dimension</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Create Dimension Modal -->

    <!-- Edit Dimension Modal -->
    <div class="modal fade" id="editDimensionModal" tabindex="-1" aria-labelledby="editDimensionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editDimensionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDimensionModalLabel">Edit Dimension</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-dimension-id" name="id">
                        <div class="mb-3">
                            <label for="edit-dimension-name" class="form-label">Dimension Name</label>
                            <input type="text" class="form-control" id="edit-dimension-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-dimension-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-dimension-description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Dimension</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            $('#create-dimension-description').summernote({
                placeholder: 'Enter description here...',
                tabsize: 2,
                height: 200
            });

            $('#edit-dimension-description').summernote({
                placeholder: 'Enter description here...',
                tabsize: 2,
                height: 200
            });

            // When an edit button is clicked, retrieve the data attributes and fill the modal form.
            $('.edit-btn').click(function() {
                var dimensionId = $(this).data('id');
                var dimensionName = $(this).data('name');
                var dimensionDescription = $(this).data('description');

                // Set the input values in the edit modal.
                $('#edit-dimension-id').val(dimensionId);
                $('#edit-dimension-name').val(dimensionName);
                // Set the Summernote editor content for the description.
                $('#edit-dimension-description').summernote('code', dimensionDescription);

                // Update the form action to point to the correct update URL.
                $('#editDimensionForm').attr('action', '/admin/dimensions/' + dimensionId);
            });
        });
    </script>
@endpush
