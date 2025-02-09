@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Start Page Title -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Task Queue',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [['name' => 'Task Queue']],
            ])
            <!-- End Page Title -->

            <!-- Empty Queue Card -->
            <div class="card">
                <div class="card-body text-center">
                    <i data-feather="inbox" class="mb-3" style="width:48px; height:48px;"></i>
                    <h4 class="mb-3">Your Task Queue is Empty</h4>
                    <p class="text-muted">
                        There are currently no tasks assigned to you. Please check back later or contact your supervisor if
                        you believe this is an error.
                    </p>
                </div>
            </div>

        </div><!-- container-fluid -->
    </div><!-- page-content -->
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endpush
