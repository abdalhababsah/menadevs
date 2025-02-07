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

                            <!-- Welcome Text -->
                            <div class="text-center mb-4">
                                <h5 class="fw-bold">Welcome Back!</h5>
                                <p class="text-muted">Sign in to continue to Minia.</p>
                            </div>

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-3" :status="session('status')" />

                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required autofocus placeholder="Enter email">
                                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                                </div>

                                <!-- Password Input -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label for="password" class="form-label mb-0">Password</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                                Forgot password?
                                            </a>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                               required placeholder="Enter password">
                                        <button class="btn btn-outline-secondary" type="button" id="password-addon">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </button>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                        <label class="form-check-label" for="remember_me">
                                            Remember me
                                        </label>
                                    </div>
                                </div>

                                <!-- Login Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary">Log in</button>
                                </div>
                            </form>


                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="mb-0">Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                        Signup now
                                    </a>
                                </p>
                            </div>

                            <!-- Footer -->
                            <div class="text-center text-muted mt-4">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Minia. 
                                    Crafted with <i class="bi bi-heart-fill text-danger"></i> by Themesbrand
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>