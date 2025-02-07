<div class="card-body">
    <!-- Warning Alert -->
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-alert-outline me-2 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>Warning!</strong>
                    <p class="mb-0">{{ session('warning') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Info Alert -->
    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-information-outline me-2 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>Info!</strong>
                    <p class="mb-0">{{ session('info') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <!-- Personal Information Card -->


    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-check-circle-outline me-2 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>Success!</strong>
                    <p class="mb-0">{{ session('status') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-alert-circle-outline me-2 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>Error!</strong>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Rest of your form code -->
</div>
