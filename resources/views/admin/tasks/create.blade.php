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

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create a Task</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.tasks.store') }}">
                        @csrf
                        
                        <!-- Task Details Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Task Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Task Description <span class="text-danger">*</span> 
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
                                        <label class="form-label">Category <span class="text-danger">*</span>
                                            <span class="text-danger small error-message"></span>
                                        </label>
                                        <select name="category_id" class="form-select">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Language <span class="text-danger">*</span>
                                            <span class="text-danger small error-message"></span>
                                        </label>
                                        <select name="language_id" class="form-select">
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
                                        <label class="form-label">Maximum Review Level <span class="text-danger">*</span>
                                            <span class="text-danger small error-message"></span>
                                        </label>
                                        <input type="number" name="max_review_level" class="form-control" value="3">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Reviewing Duration (Minutes) <span class="text-danger">*</span>
                                            <span class="text-danger small error-message"></span>
                                        </label>
                                        <input type="number" name="reviewing_duration_minutes" class="form-control" min="1">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Attempting Duration (Minutes) <span class="text-danger">*</span>
                                            <span class="text-danger small error-message"></span>
                                        </label>
                                        <input type="number" name="attempting_duration_minutes" class="form-control" min="1">
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
            
                        <!-- Task Copies Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Task Copies</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Number of Copies (Max 100) <span class="text-danger">*</span>
                                            <span class="text-danger small error-message"></span>
                                        </label>
                                        <input type="number" name="task_count" class="form-control" min="1" max="100">
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
                    </form>
                </div>
            </div>
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
            ]
        });

        // Function to update available dimension options
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

        // Add new dimension selection
        $(document).on('click', '#add-dimension-btn', function () {
            if ($('select[name="dimensions[]"]').length < maxDimensionsAllowed) {
                let newInput = `
                    <div class="input-group mb-2 dimension-wrapper">
                        <select name="dimensions[]" class="form-control dimension-select">
                            <option value="">Select Dimension</option>
                            @foreach ($dimensions as $dimension)
                                <option value="{{ $dimension->id }}">{{ $dimension->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger remove-dimension">-</button>
                    </div>`;
                $('#dimensions-container').append(newInput);
                updateDimensionOptions();
            }
        });

        // Remove a dimension field
        $(document).on('click', '.remove-dimension', function () {
            $(this).closest('.dimension-wrapper').remove();
            updateDimensionOptions();
        });

        // Validate fields dynamically and show error messages next to labels
        function validateField(field, message) {
            let label = field.closest('.mb-3').find('.error-message');
            if (!field.val().trim()) {
                field.addClass('is-invalid');
                label.text(message);
                return false;
            } else {
                field.removeClass('is-invalid');
                label.text('');
                return true;
            }
        }

        // Validate form before submission
        $('form').on('submit', function (e) {
            let isValid = true;

            isValid &= validateField($('#task_description'), 'Task description is required.');
            isValid &= validateField($('select[name="category_id"]'), 'Category is required.');
            isValid &= validateField($('select[name="language_id"]'), 'Language is required.');

            let maxReviewField = $('input[name="max_review_level"]');
            if (maxReviewField.val().trim() === '' || maxReviewField.val() <= 0) {
                isValid = false;
                maxReviewField.addClass('is-invalid')
                    .closest('.mb-3').find('.error-message').text('Enter a valid review level.');
            } else {
                maxReviewField.removeClass('is-invalid')
                    .closest('.mb-3').find('.error-message').text('');
            }
            let reviewingDurationField = $('input[name="reviewing_duration_minutes"]');
            if (reviewingDurationField.val().trim() === '' || reviewingDurationField.val() <= 0) {
                isValid = false;
                reviewingDurationField.addClass('is-invalid')
                    .closest('.mb-3').find('.error-message').text('Enter a valid reviewing duration.');
            } else {
                reviewingDurationField.removeClass('is-invalid')
                    .closest('.mb-3').find('.error-message').text('');
            }

            let attemptingDurationField = $('input[name="attempting_duration_minutes"]');
            if (attemptingDurationField.val().trim() === '' || attemptingDurationField.val() <= 0) {
                isValid = false;
                attemptingDurationField.addClass('is-invalid')
                    .closest('.mb-3').find('.error-message').text('Enter a valid attempting duration.');
            } else {
                attemptingDurationField.removeClass('is-invalid')
                    .closest('.mb-3').find('.error-message').text('');
            }

            $('select[name="dimensions[]"]').each(function () {
                isValid &= validateField($(this), 'Please select a dimension.');
            });

            let taskCountField = $('input[name="task_count"]');


            if (!isValid) e.preventDefault();
        });

        // Remove validation errors when input changes
        $('input, select, textarea').on('input change', function () {
            $(this).removeClass('is-invalid')
                .closest('.mb-3').find('.error-message').text('');
        });

    });
</script>
@endpush
