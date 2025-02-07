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
                                <p class="text-muted">Enter your email to reset your password</p>
                            </div>

                            <!-- Description -->
                            <div class="alert alert-info mb-4">
                                <p class="mb-0">
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </p>
                            </div>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success mb-4">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <!-- Reset Password Form -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <!-- Email Input -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required autofocus 
                                           placeholder="Enter your email">
                                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Email Password Reset Link') }}
                                    </button>
                                </div>

                                <!-- Back to Login -->
                                <div class="text-center">
                                    <p class="mb-0">
                                        <a href="{{ route('login') }}" class="text-decoration-none">
                                            <i class="bi bi-arrow-left"></i> Back to Login
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