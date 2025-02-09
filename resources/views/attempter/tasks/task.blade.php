@extends('dashboard-layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    
        <!-- Start Page Title -->
        @include('dashboard-layouts.partials.page-title', [
            'title' => 'Task Queue',
            'breadcrumbHome' => 'Dashboard',
            'breadcrumbHomeUrl' => route('dashboard'),
            'breadcrumbItems' => [['name' => 'Task Queue']]
        ])
        <!-- End Page Title -->

        <div>task blade</div>
    
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