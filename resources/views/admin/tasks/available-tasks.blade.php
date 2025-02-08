@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Available Tasks',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [
                    ['name' => 'Tasks', 'url' => route('admin.tasks.available')],
                ]
            ])
            @include('components.alerts')

            <!-- Filters Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Filter Tasks</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.tasks.available') }}">
                                <div class="row g-3 align-items-center">
                                    <!-- Category Filter -->
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="mb-3 mb-lg-0">
                                            <select name="category_id" class="form-select">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Language Filter -->
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="mb-3 mb-lg-0">
                                            <select name="language_id" class="form-select">
                                                <option value="">Select Language</option>
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" 
                                                            {{ request('language_id') == $language->id ? 'selected' : '' }}>
                                                        {{ $language->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="d-flex justify-content-lg-end gap-2">
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                            <a href="{{ route('admin.tasks.available') }}" class="btn btn-outline-secondary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Filters Card -->

            <!-- Tasks Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Available Tasks</h4>

                            <h4 class="card-title text-primary">Total Tasks: {{ $totalTasks }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task Description</th>
                                            <th>Category</th>
                                            <th>Language</th>
                                            <th>Dimensions</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <th scope="row">{{ $task->id }}</th>
                                                <td>{!! \Illuminate\Support\Str::limit($task->task_description, 50) !!}</td>
                                                <td>{{ $task->category->name ?? 'N/A' }}</td>
                                                <td>{{ $task->language->name ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($task->dimensions->isNotEmpty())
                                                        @foreach ($task->dimensions as $dimension)
                                                            <span class="badge bg-primary">{{ $dimension->name }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted">No Dimensions</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="
                                                    {{-- {{ route('admin.tasks.show', $task->id) }} --}}
                                                     " class="btn btn-primary btn-sm">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($tasks->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">No available tasks found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $tasks->links() }}
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
@endsection