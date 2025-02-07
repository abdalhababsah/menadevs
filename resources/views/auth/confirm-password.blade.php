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
                                <h5 class="fw-bold">Confirm Password</h5>
                                <p class="text-muted">Secure area authentication required</p>
                            </div>

                            <!-- Security Message -->
                            <div class="alert alert-warning mb-4">
                                <p class="mb-0">
                                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                </p>
                            </div>

                            <!-- Confirm Password Form -->
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <!-- Password Input -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" 
                                               name="password" required autocomplete="current-password"
                                               placeholder="Enter your password">
                                        <button class="btn btn-outline-secondary" type="button" id="password-addon">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>

                                <!-- Back Link -->
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