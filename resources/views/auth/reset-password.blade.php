<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <!-- Logo -->
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="Logo" height="28" class="mb-2">
                                <h4 class="text-dark">Minia</h4>
                            </div>

                            <!-- Title -->
                            <div class="text-center mb-4">
                                <h5 class="fw-bold">Reset Password</h5>
                                <p class="text-muted">Create your new password</p>
                            </div>

                            <!-- Reset Password Form -->
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Hidden Token Input -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $request->email) }}" required autofocus 
                                           autocomplete="username" placeholder="Enter your email">
                                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                                </div>

                                <!-- New Password Input -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" 
                                               name="password" required autocomplete="new-password"
                                               placeholder="Enter new password">
                                        <button class="btn btn-outline-secondary" type="button" id="password-addon">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                                </div>

                                <!-- Confirm Password Input -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation" 
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="Confirm new password">
                                        <button class="btn btn-outline-secondary" type="button" id="confirm-password-addon">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>

                                <!-- Back to Login -->
                                <div class="text-center">
                                    <p class="mb-0">
                                        <a href="{{ route('login') }}" class="text-decoration-none">
                                            <i class="dripicons-arrow-left"></i> Back to Login
                                        </a>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>