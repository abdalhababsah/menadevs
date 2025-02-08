@extends('dashboard-layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            @include('dashboard-layouts.partials.page-title', [
                'title' => 'Profile',
                'breadcrumbHome' => 'Dashboard',
                'breadcrumbHomeUrl' => route('dashboard'),
                'breadcrumbItems' => [
                    ['name' => 'Profile', 'url' => route('profile.edit')],
                ]
            ])
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img src="{{ asset('assets/images/UserAvatar.png') }}" alt=""
                                                    class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1">{{ $user->first_name }} {{ $user->last_name }}
                                                </h5>
                                                <p class="m-0 mb-0 text-muted font-size-13">{{ $user->email }}</p>
                                                <p class="m-0 mb-0 text-muted font-size-13">Role: {{ $user->role->name }}</p>
                                                <p class="m-0 mb-0 text-muted font-size-13">ID: {{ $user->role->id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  @include('components.alerts')

                    <!-- Password Update Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword('current_password')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password', 'updatePassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword('password')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password', 'updatePassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword('password_confirmation')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Prefered languages</h5>
                            <div class="d-flex flex-wrap gap-2 font-size-16">
                                <a href="#" class="badge bg-primary-subtle text-primary">Photoshop</a>
                                <a href="#" class="badge bg-primary-subtle text-primary">illustrator</a>
                                <a href="#" class="badge bg-primary-subtle text-primary">HTML</a>
                                <a href="#" class="badge bg-primary-subtle text-primary">CSS</a>
                                <a href="#" class="badge bg-primary-subtle text-primary">Javascript</a>
                                <a href="#" class="badge bg-primary-subtle text-primary">Php</a>
                                <a href="#" class="badge bg-primary-subtle text-primary">Python</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = event.currentTarget.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('mdi-eye');
                icon.classList.add('mdi-eye-off');
            } else {
                input.type = 'password';
                icon.classList.remove('mdi-eye-off');
                icon.classList.add('mdi-eye');
            }
        }
    </script>
@endsection
