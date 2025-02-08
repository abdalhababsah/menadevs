@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title and Create Button -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Languages',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [
                    ['name' => 'Languages', 'url' => route('languages.index')],
                ]
            ])
            @include('components.alerts')

            <!-- Languages Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Languages</h4>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createLanguageModal">
                                Create Language
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Language Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($languages as $language)
                                            <tr>
                                                <th scope="row">{{ $language->id }}</th>
                                                <td>{{ $language->name }}</td>
                                                <td class="text-end"> <!-- Align buttons to the right -->
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $language->id }}" data-name="{{ $language->name }}"
                                                        data-bs-toggle="modal" data-bs-target="#editLanguageModal">
                                                        Edit
                                                    </button>
                                    
                                                    <form action="{{ route('languages.destroy', $language->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($languages->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">No languages found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $languages->links() }}
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

    <!-- Create Language Modal -->
    <div class="modal fade" id="createLanguageModal" tabindex="-1" aria-labelledby="createLanguageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('languages.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLanguageModalLabel">Create Language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-language-name" class="form-label">Language Name</label>
                            <input type="text" class="form-control" id="create-language-name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create Language</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Create Language Modal -->

    <!-- Edit Language Modal -->
    <div class="modal fade" id="editLanguageModal" tabindex="-1" aria-labelledby="editLanguageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <!-- The form's action will be dynamically updated using jQuery -->
            <form id="editLanguageForm" method="POST">
                @csrf
                @method('PUT') <!-- Ensure correct method for updates -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLanguageModalLabel">Edit Language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-language-name" class="form-label">Language Name</label>
                            <input type="text" class="form-control" id="edit-language-name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Language</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Edit Language Modal -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // When an edit button is clicked, retrieve the data attributes and fill the modal form.
            $('.edit-btn').click(function() {
                var languageId = $(this).data('id');
                var languageName = $(this).data('name');

                // Set the input value in the edit modal.
                $('#edit-language-name').val(languageName);

                // Update the form action to point to the correct update URL.
                $('#editLanguageForm').attr('action', '/admin/languages/' + languageId);
            });
        });
    </script>
@endpush