@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Dashboard',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('attempter.dashboard'),
                // 'breadcrumbItems' => [
                //     ['name' => 'Users', 'url' => route('users.index')],
                //     ['name' => 'Edit User']
                // ]
            ])
            <!-- end page title -->

            <div class="row">
                <!-- Card 1: Working Hours -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Text Content -->
                                <div class="col">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Working Hours</span>
                                    <h4 class="mb-1">
                                        <span class="counter-value" data-target="8">0</span> h Today
                                    </h4>
                                    <p class="mb-0 text-muted font-size-13">
                                        <span class="counter-value" data-target="40">0</span> h This Week
                                    </p>
                                </div>
                                <!-- Icon -->
                                <div class="col-auto ms-3">
                                    <div class="icon-lg bg-primary bg-soft rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i data-feather="clock" style="width:24px; height:24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Tasks Completed -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Text Content -->
                                <div class="col">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Tasks Completed</span>
                                    <h4 class="mb-1">
                                        <span class="counter-value" data-target="5">0</span> Today
                                    </h4>
                                    <p class="mb-0 text-muted font-size-13">
                                        <span class="counter-value" data-target="25">0</span> This Week
                                    </p>
                                </div>
                                <!-- Icon -->
                                <div class="col-auto ms-3">
                                    <div class="icon-lg bg-success bg-soft rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i data-feather="check-square" style="width:24px; height:24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Available Tasks -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Text Content -->
                                <div class="col">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available Tasks</span>
                                    <h4 class="mb-1">
                                        <span class="counter-value" data-target="12">0</span>
                                    </h4>
                                    <p class="mb-0 text-muted font-size-13">in Your Expertise</p>
                                </div>
                                <!-- Icon -->
                                <div class="col-auto ms-3">
                                    <div class="icon-lg bg-warning bg-soft rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i data-feather="list" style="width:24px; height:24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Pending Reviews -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Text Content -->
                                <div class="col">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Pending Reviews</span>
                                    <h4 class="mb-1">
                                        <span class="counter-value" data-target="3">0</span>
                                    </h4>
                                    <p class="mb-0 text-muted font-size-13">Awaiting Action</p>
                                </div>
                                <!-- Icon -->
                                <div class="col-auto ms-3">
                                    <div class="icon-lg bg-danger bg-soft rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i data-feather="alert-triangle" style="width:24px; height:24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <h6 class="text-uppercase text-muted mb-1">Project Information</h6>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <!-- Project Card -->
                    <div class="card card-h-100">
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Title Section inside the card -->

                            <!-- Header: Project Title and Action Button -->
                            <div class="d-flex flex-wrap align-items-center mb-4">
                                <h5 class="card-title me-2 mb-0">
                                    <i class="fas fa-rocket text-primary me-2"></i>
                                    Prompt Training Project
                                </h5>
                                <div class="ms-auto">
                                    <a href="{{ route('attempter.tasking.start') }}" class="btn btn-primary btn-sm">
                                        <i data-feather="play" class="me-1"></i>
                                        Start Tasking
                                    </a>
                                </div>
                            </div>
                            <!-- Project Description -->
                            <p class="text-muted mb-0">
                                <i data-feather="info" class="text-secondary me-2"></i>
                                This project focuses on training advanced AI models using high-quality real-world prompts.
                                The goal is to curate a diverse dataset that refines model understanding and improves
                                language processing.
                                Tasks include data collection, prompt refinement, and iterative model training.
                            </p>
                        </div>
                        <!-- End Card body -->
                    </div>
                    <!-- End Project Card -->
                </div>
            </div>
        </div>

        <!-- end col -->
    </div> <!-- end row-->

    </div>
    <!-- container-fluid -->
    </div>
@endsection
