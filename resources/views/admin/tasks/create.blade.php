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

                        <div class="mb-3">
                            <label class="form-label">Task Description <span class="text-danger small error-message"></span></label>
                            <textarea id="task_description" name="task_description" class="form-control"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger small error-message"></span></label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Language <span class="text-danger small error-message"></span></label>
                            <select name="language_id" class="form-control">
                                <option value="">Select Language</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Maximum Review Level <span class="text-danger small error-message"></span></label>
                            <input type="number" name="max_review_level" class="form-control" value="3">
                        </div>

                        <!-- Dimensions Selection -->
                        <div id="dimensions-container">
                            <label class="form-label">Task Dimensions <span class="text-danger small error-message"></span></label>
                            <div class="input-group mb-2">
                                <select name="dimensions[]" class="form-control">
                                    <option value="">Select Dimension</option>
                                    @foreach ($dimensions as $dimension)
                                        <option value="{{ $dimension->id }}">{{ $dimension->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" id="add-dimension-btn" class="btn btn-success">+</button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Number of Copies (Max 100) <span class="text-danger small error-message"></span></label>
                            <input type="number" name="task_count" class="form-control" min="1" max="100">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Task</button>
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
