<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">



<x-head />

<body class="d-flex align-items-center justify-content-center min-vh-100 px-3
    bg-neutral-100 text-dark
    dark-mode bg-neutral-900 text-white">

    <div class="container shadow-lg rounded-4 overflow-hidden bg-white">
        <div class="row g-0">

            <!-- Text Section -->
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5 text-center text-lg-start">
                <h1 class="display-1 fw-bold mb-1 text-neutral-500">
                    Welcome to <span class="text-primary">HRoS</span>
                </h1>
                <p class="lead text-muted mb-1">
                    Human Resource Operating System for RCC Maldives
                </p>
                <p class="small text-secondary mb-12">
                    Rasheed Carpentry and Construction Pvt Ltd is one of the most respected general contracting companies in the Maldives, known for delivering large and complex projects on time, within budget, and with outstanding quality.
                </p>
                <div class="d-flex justify-content-center flex-column">
                    <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 rounded-l shadow-lg "> Login </a>
                    <button type="button" class=" bg-neutral-900 btn  rounded-m shadow-m mt-6" data-theme-toggle></button>
                </div>

            </div>

            <!-- Lottie Animation -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center bg-light-subtle p-4">
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" background="transparent" speed="1" style="width: 100%; max-width: 400px;" loop autoplay>
                </lottie-player>
            </div>
        </div>
    </div>
    <x-script />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
