<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />

<body class="transition bg-light text-dark">

    <section class="py-5 d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 bg-white rounded-3 shadow overflow-hidden">
                    <div class="row g-0">
                        <!-- Left Auth Image -->
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center bg-light-subtle">
                            <img src="{{ asset('assets/images/auth/auth-img.png') }}" alt="Auth Image" class="img-fluid w-100 h-100 object-fit-cover">
                        </div>

                        <!-- Right Login Section -->
                        <div class="col-lg-6 p-4 p-sm-5 bg-body-secondary d-flex flex-column justify-content-center">
                            <div class="mx-auto w-100" style="max-width: 100%;">
                        <div class="text-center mb-5">
                            <a href="{{ route('login') }}" class="d-inline-block mb-4">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" width="250px" class="img-fluid" style="max-width: 220px;">
                            </a>
                            <h4 class="fw-bold text-body mt-4">Sign In to your Account</h4>
                            <p class="text-muted small">Welcome back! Please enter your credentials</p>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <iconify-icon icon="mage:email"></iconify-icon>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}" autofocus placeholder="Enter your email">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                                    <span class="input-group-text bg-white toggle-password cursor-pointer" data-toggle="#password">
                                        <i class="ri-eye-line text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-decoration-none text-primary small">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Sign In</button>

                            <!-- Theme toggle -->
                            <div class="text-center my-4">
                                <button type="button" class="bg-neutral-900 btn rounded-m shadow-m mt-6" data-theme-toggle>
                                    Light/Dark
                                </button>
                            </div>

                            <!-- Social -->
                            <div class="d-flex justify-content-center gap-3 my-4">
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center gap-2">
                                    <iconify-icon icon="ic:baseline-facebook" class="text-primary"></iconify-icon> Facebook
                                </button>
                                <button type="button" class="btn btn-outline-danger d-flex align-items-center gap-2">
                                    <iconify-icon icon="logos:google-icon" class="text-danger"></iconify-icon> Google
                                </button>
                            </div>

                            <div class="text-center">
                                <span class="small">Don't have an account?</span>
                                <a href="{{ route('register') }}" class="text-decoration-none text-primary small">Create one</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>

    @php
    $script = '<script>
        function initializePasswordToggle(toggleSelector) {
            document.querySelectorAll(toggleSelector).forEach(btn => {
                btn.addEventListener("click", function() {
                    const target = document.querySelector(btn.getAttribute("data-toggle"));
                    const icon = btn.querySelector("i");
                    if (target.type === "password") {
                        target.type = "text";
                        icon.classList.replace("ri-eye-line", "ri-eye-off-line");
                    } else {
                        target.type = "password";
                        icon.classList.replace("ri-eye-off-line", "ri-eye-line");
                    }
                });
            });
        }

        initializePasswordToggle(".toggle-password");

        // Password field toggle initialized above

    </script>';
    @endphp

    <x-script />
</body>
</html>
