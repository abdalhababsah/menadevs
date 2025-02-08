@extends('dashboard-layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        @include('dashboard-layouts.partials.page-title', [
            'title' => 'Create Task',
            'breadcrumbHome' => 'Dashboard',
            'breadcrumbHomeUrl' => route('dashboard'),
            'breadcrumbItems' => [['name' => 'Tasks', 'url' => route('admin.tasks.create')]],
        ])

        @include('components.alerts')

        <!-- Open the form before the card so that the header is included -->
        <form method="POST" action="{{ route('admin.tasks.store') }}">
            @csrf
            <div class="card">
                <!-- Card Header with "Create a Task" title and Number of Copies input -->
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title text-primary mb-0">Create a Task</h4>
                        <div class="mt-2 d-flex align-items-top">
                            <label class="form-label text-primary mb-0">
                                Copies (<span class="text-danger">Max 100</span>)&nbsp;&nbsp;
                            </label>
                            <input type="number" name="task_count" class="form-control" style="width: 80px;" min="1" max="100">
                        </div>
                    </div>
                </div>
                <!-- End Card Header -->

                <div class="card-body">
                    <!-- Task Details Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Task Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="task_description" class="form-label">
                                        Task Description <span class="text-danger">*</span>
                                        <span class="text-danger small error-message"></span>
                                    </label>
                                    <textarea id="task_description" name="task_description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Classification Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Classification</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">
                                        Category <span class="text-danger">*</span>
                                        <span class="text-danger small error-message"></span>
                                    </label>
                                    <select id="category_id" name="category_id" class="form-select">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="language_id" class="form-label">
                                        Language <span class="text-danger">*</span>
                                        <span class="text-danger small error-message"></span>
                                    </label>
                                    <select id="language_id" name="language_id" class="form-select">
                                        <option value="">Select Language</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Duration Settings Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Duration Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="max_review_level" class="form-label">
                                        Maximum Review Level <span class="text-danger">*</span>
                                        <span class="text-danger small error-message"></span>
                                    </label>
                                    <input type="number" id="max_review_level" name="max_review_level" class="form-control" value="3">
                                </div>
                                <div class="col-md-4">
                                    <label for="reviewing_duration_minutes" class="form-label">
                                        Reviewing Duration (Minutes) <span class="text-danger">*</span>
                                        <span class="text-danger small error-message"></span>
                                    </label>
                                    <input type="number" id="reviewing_duration_minutes" name="reviewing_duration_minutes" class="form-control" min="1">
                                </div>
                                <div class="col-md-4">
                                    <label for="attempting_duration_minutes" class="form-label">
                                        Attempting Duration (Minutes) <span class="text-danger">*</span>
                                        <span class="text-danger small error-message"></span>
                                    </label>
                                    <input type="number" id="attempting_duration_minutes" name="attempting_duration_minutes" class="form-control" min="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dimensions Section -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Task Dimensions</h5>
                            <button type="button" id="add-dimension-btn" class="btn btn-sm btn-success">
                                <i class="fas fa-plus me-1"></i> Add Dimension
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="dimensions-container">
                                <div class="input-group mb-2">
                                    <select name="dimensions[]" class="form-select">
                                        <option value="">Select Dimension</option>
                                        @foreach ($dimensions as $dimension)
                                            <option value="{{ $dimension->id }}">{{ $dimension->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Create Task
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    let totalDimensions = {{ count($dimensions) }};
    let maxDimensionsAllowed = totalDimensions;

    // Initialize Summernote for task description
    $('#task_description').summernote({
        height: 150,
        placeholder: "Enter task description...",
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onChange: function(contents) {
                // Strip HTML tags and validate
                let stripped = $('<div>').html(contents).text().trim();
                validateField($('#task_description'), 'Task description is required.', stripped.length > 0);
            }
        }
    });

    // Function to get the error container associated with a field (by checking its label's error-message span)
    function getErrorContainer(field) {
        let id = field.attr('id');
        if (id) {
            let label = $('label[for="' + id + '"]');
            if (label.length) {
                return label.find('.error-message');
            }
        }
        return field.closest('.mb-3').find('.error-message');
    }

    // Function to validate a field and display an error message if invalid
    function validateField(field, message, condition) {
        let errorContainer = getErrorContainer(field);
        if (!condition) {
            field.addClass('is-invalid');
            errorContainer.text(message);
            return false;
        } else {
            field.removeClass('is-invalid');
            errorContainer.text('');
            return true;
        }
    }

    // Update available dimension options (prevent duplicate selections)
    function updateDimensionOptions() {
        let selectedValues = [];
        $('select[name="dimensions[]"]').each(function () {
            let value = $(this).val();
            if (value) selectedValues.push(value);
        });
        $('select[name="dimensions[]"]').each(function () {
            let currentVal = $(this).val();
            $(this).find('option').each(function () {
                let optionVal = $(this).val();
                if (optionVal) {
                    $(this).prop('disabled', selectedValues.includes(optionVal) && optionVal !== currentVal);
                }
            });
        });
        $('#add-dimension-btn').prop('disabled', $('select[name="dimensions[]"]').length >= maxDimensionsAllowed);
    }

    // Add new dimension selection field dynamically
    $(document).on('click', '#add-dimension-btn', function () {
        if ($('select[name="dimensions[]"]').length < maxDimensionsAllowed) {
            let newInput = `
                <div class="input-group mb-2 dimension-wrapper">
                    <select name="dimensions[]" class="form-select dimension-select">
                        <option value="">Select Dimension</option>
                        @foreach ($dimensions as $dimension)
                            <option value="{{ $dimension->id }}">{{ $dimension->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger remove-dimension">-</button>
                </div>
                <span class="text-danger small error-message"></span>`;
            $('#dimensions-container').append(newInput);
            updateDimensionOptions();
        }
    });

    // Remove a dimension selection field
    $(document).on('click', '.remove-dimension', function () {
        $(this).closest('.dimension-wrapper').remove();
        updateDimensionOptions();
    });

    // Validate form on submission
    $('form').on('submit', function (e) {
        let isValid = true;

        // Validate Summernote editor content (Task Description)
        let descriptionContent = $('#task_description').summernote('code');
        let strippedDescription = $('<div>').html(descriptionContent).text().trim();
        isValid &= validateField($('#task_description'), 'Task description is required.', strippedDescription.length > 0);

        // Validate Category
        isValid &= validateField($('#category_id'), 'Category is required.', $('#category_id').val() !== "");

        // Validate Language
        isValid &= validateField($('#language_id'), 'Language is required.', $('#language_id').val() !== "");

        // Validate Maximum Review Level
        let maxReviewField = $('#max_review_level');
        isValid &= validateField(maxReviewField, 'Enter a valid review level.', maxReviewField.val().trim() !== "" && maxReviewField.val() > 0);

        // Validate Reviewing Duration
        let reviewingDurationField = $('#reviewing_duration_minutes');
        isValid &= validateField(reviewingDurationField, 'Enter a valid reviewing duration.', reviewingDurationField.val().trim() !== "" && reviewingDurationField.val() > 0);

        // Validate Attempting Duration
        let attemptingDurationField = $('#attempting_duration_minutes');
        isValid &= validateField(attemptingDurationField, 'Enter a valid attempting duration.', attemptingDurationField.val().trim() !== "" && attemptingDurationField.val() > 0);

        // Validate each Dimension selection
        $('select[name="dimensions[]"]').each(function () {
            isValid &= validateField($(this), 'Please select a dimension.', $(this).val() !== "");
        });

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Remove validation errors on input change
    $('input, select, textarea').on('input change', function () {
        let errorContainer = getErrorContainer($(this));
        $(this).removeClass('is-invalid');
        errorContainer.text('');
    });
});
</script>
@endpush