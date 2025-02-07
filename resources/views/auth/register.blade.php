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
                                <h5 class="fw-bold">Create New Account</h5>
                                <p class="text-muted">Get your free Minia account now</p>
                            </div>

                            <!-- Register Form -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name Input -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required autofocus 
                                           autocomplete="name" placeholder="Enter your name">
                                    <x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
                                </div>

                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required 
                                           autocomplete="username" placeholder="Enter your email">
                                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                                </div>

                                <!-- Password Input -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" 
                                               name="password" required autocomplete="new-password"
                                               placeholder="Enter password">
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                                </div>

                                <!-- Confirm Password Input -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation" 
                                               name="password_confirmation" required 
                                               autocomplete="new-password" placeholder="Confirm password">
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
                                </div>

                                <!-- Register Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>


                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="mb-0">Already have an account? 
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                        Login
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>