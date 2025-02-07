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
                                <h5 class="fw-bold">Verify Your Email Address</h5>
                                <p class="text-muted">Complete your registration by verifying your email</p>
                            </div>

                            <!-- Verification Message -->
                            <div class="alert alert-info mb-4">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            <!-- Success Message -->
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success mb-4">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <!-- Resend Verification Email Form -->
                                    <form method="POST" action="{{ route('verification.send') }}" class="d-grid">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-envelope me-1"></i>
                                            {{ __('Resend Verification Email') }}
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="col-sm-6">
                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}" class="d-grid">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="bi bi-box-arrow-right me-1"></i>
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Email Icon -->
                            <div class="text-center mb-4">
                                <i class="bi bi-envelope-check text-primary" style="font-size: 3rem;"></i>
                            </div>

                            <!-- Additional Information -->
                            <div class="text-center text-muted">
                                <p class="mb-0">
                                    Please check your email inbox and spam folder for the verification link.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
