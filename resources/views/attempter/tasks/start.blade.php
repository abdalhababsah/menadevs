@extends('dashboard-layouts.app')

@section('styles')
<!-- CodeMirror CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
<!-- Font Awesome (for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <!-- Page Title -->
    @include('dashboard-layouts.partials.page-title', [
      'title' => 'Start Task',
      'breadcrumbHome' => 'Dashboard',
      'breadcrumbHomeUrl' => route('attempter.dashboard'),
      'breadcrumbItems' => [['name' => 'Start Task']]
    ])

    <!-- Task Description Card -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Task Description</h5>
        <div class="border p-3">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Donec blandit, lorem in semper dignissim, nisl nunc aliquet metus, vel efficitur arcu eros sed magna. Vivamus non justo in urna malesuada dictum.</p>
        </div>
      </div>
    </div>

    <!-- Task Language & Previous Reviews Card -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Task Language: English</h5>
        </div>
        <!-- Previous Reviews: Shown only if the task has parents -->
        <div>
          <h6 class="text-muted">Previous Reviews</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <strong>Reviewer 1:</strong> Rating: <span class="badge bg-danger">Rejected</span> – "Needs improvement in clarity."
            </li>
            <li class="mb-2">
              <strong>Reviewer 2:</strong> Rating: <span class="badge bg-warning">Partially Fulfilled</span> – "Some aspects are acceptable."
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Prompt Markdown Editor Card (Without Toolbar) -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Task Prompt</h5>
        <div class="markdown-editor-container">
          <!-- The toolbar has been removed for a cleaner, tool-less editor -->
          <div class="editor-wrapper">
            <textarea class="form-control markdown-editor" name="prompt" rows="10" placeholder="Enter prompt in markdown...">
            </textarea>
            <div class="preview-panel d-none"></div>
          </div>
          <div class="editor-footer">
            <small class="text-muted character-count">0 characters</small>
            <small class="text-muted">Press Ctrl+Space for suggestions</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Response Sections -->
    <div class="row">
      <!-- Left Column: Generated Response -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Generated Response</h5>
            <div class="markdown-editor-container">
              <!-- No toolbar here either -->
              <div class="editor-wrapper">
                <textarea class="form-control markdown-editor" name="generated_response" rows="10" placeholder="Generated response in markdown...">
                </textarea>
                <div class="preview-panel d-none"></div>
              </div>
              <div class="editor-footer">
                <small class="text-muted character-count">0 characters</small>
                <small class="text-muted">Press Ctrl+Space for suggestions</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Dimension Evaluations -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Dimension Evaluation</h5>
            <!-- Dimension Block 1: Accuracy -->
            <div class="border p-3 mb-3">
              <h6 class="mb-1">Accuracy</h6>
              <p class="text-muted mb-2">Measures the correctness and precision of the response.</p>
              <!-- Rating Buttons -->
              <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <label class="btn btn-outline-primary">
                  <input type="radio" name="accuracy_rating" value="major_issue"> Major Issue
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="accuracy_rating" value="minor_issue"> Minor Issue
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="accuracy_rating" value="partially_fulfilled"> Partially Fulfilled
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="accuracy_rating" value="completely_fulfilled"> Completely Fulfilled
                </label>
              </div>
              <!-- Justification Box -->
              <textarea class="form-control" rows="3" placeholder="Justification for Accuracy..."></textarea>
            </div>

            <!-- Dimension Block 2: Completeness -->
            <div class="border p-3 mb-3">
              <h6 class="mb-1">Completeness</h6>
              <p class="text-muted mb-2">Measures whether all aspects of the task were addressed.</p>
              <!-- Rating Buttons -->
              <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <label class="btn btn-outline-primary">
                  <input type="radio" name="completeness_rating" value="major_issue"> Major Issue
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="completeness_rating" value="minor_issue"> Minor Issue
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="completeness_rating" value="partially_fulfilled"> Partially Fulfilled
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="completeness_rating" value="completely_fulfilled"> Completely Fulfilled
                </label>
              </div>
              <!-- Justification Box -->
              <textarea class="form-control" rows="3" placeholder="Justification for Completeness..."></textarea>
            </div>

            <!-- Dimension Block 3: Clarity -->
            <div class="border p-3 mb-3">
              <h6 class="mb-1">Clarity</h6>
              <p class="text-muted mb-2">Assesses the clarity and understandability of the response.</p>
              <!-- Rating Buttons -->
              <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <label class="btn btn-outline-primary">
                  <input type="radio" name="clarity_rating" value="major_issue"> Major Issue
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="clarity_rating" value="minor_issue"> Minor Issue
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="clarity_rating" value="partially_fulfilled"> Partially Fulfilled
                </label>
                <label class="btn btn-outline-primary">
                  <input type="radio" name="clarity_rating" value="completely_fulfilled"> Completely Fulfilled
                </label>
              </div>
              <!-- Justification Box -->
              <textarea class="form-control" rows="3" placeholder="Justification for Clarity...">The response is clear and understandable.</textarea>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Overall Justification Section -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Overall Justification</h5>
        <div class="markdown-editor-container">
          <!-- No toolbar -->
          <div class="editor-wrapper">
            <textarea class="form-control markdown-editor" name="overall_justification" rows="4" placeholder="Enter overall justification here...">
            </textarea>
            <div class="preview-panel d-none"></div>
          </div>
          <div class="editor-footer">
            <small class="text-muted character-count">0 characters</small>
            <small class="text-muted">Press Ctrl+Space for suggestions</small>
          </div>
        </div>
      </div>
    </div>

  </div><!-- container-fluid -->
</div><!-- page-content -->
@endsection

@push('scripts')
<!-- CodeMirror JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/markdown/markdown.min.js"></script>
<!-- Marked JS for markdown preview -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.2.12/marked.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.markdown-editor').forEach(function(textarea) {
        const editor = CodeMirror.fromTextArea(textarea, {
            mode: 'markdown',
            theme: 'monokai',
            lineNumbers: true,
            lineWrapping: true,
            extraKeys: { "Ctrl-Space": "autocomplete" },
            readOnly: false // Ensure the editor is editable
        });

        // Optional: update character count, etc.
        editor.on('change', () => {
            const count = editor.getValue().length;
            const charCount = textarea.closest('.editor-footer').querySelector('.character-count');
            if (charCount) {
                charCount.textContent = `${count} characters`;
            }
        });
    });
});
</script>
@endpush