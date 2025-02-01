<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Lelang</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/admin" class="nav-link">Barang Lelang</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard">Admin Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile') }}">Profil</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/barangs">Sistem Lelang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile') }}">Profil</a>
                                </li>
                            @endif
                            <li class="nav-item">
                            <a href="#" class="nav-link text-danger log-out">
                                Logout
                                <form action="/logout" method="POST" id="logging-out">
                                    @csrf
                                </form>
                            </a>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Register</a>
                            </li>
                        @endauth
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-gradient-primary sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="/profile" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/barangs" class="nav-link">
                                <i class="nav-icon fa-solid fa-box"></i>
                                <p>Barang Lelang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('barangs.dashboard') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-box"></i>
                                <p>dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-danger log-out">
                                <i class="nav-icon fa-solid fa-power-off" style="color: red;"></i>
                                Logout
                                <form action="/logout" method="POST" id="logging-out">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('.log-out').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan logout dari akun ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, logout!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#logging-out').submit();
                    }
                });
            });
        });
    </script>
         <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua elemen dengan kelas 'countdown'
        const countdownElements = document.querySelectorAll('.countdown');

        countdownElements.forEach(function (element) {
            const endTime = new Date(element.getAttribute('data-end')).getTime();

            // Fungsi untuk memperbarui timer
            function updateTimer() {
                const now = new Date().getTime();
                const timeLeft = endTime - now;

                if (timeLeft <= 0) {
                    element.innerHTML = "Waktu Habis";
                    return;
                }

                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                element.innerHTML = `${days}h ${hours}j ${minutes}m ${seconds}d`;
            }

            // Perbarui setiap detik
            updateTimer(); // Perbarui pertama kali
            const interval = setInterval(updateTimer, 1000);

            // Hentikan interval jika waktu habis
            setTimeout(() => clearInterval(interval), endTime - new Date().getTime());
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countdownElements = document.querySelectorAll('.countdown');
        const progressBarElements = document.querySelectorAll('.progress-bar');

        countdownElements.forEach((element, index) => {
            const endTime = new Date(element.getAttribute('data-end')).getTime();
            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance <= 0) {
                    element.textContent = "Waktu Habis";
                    progressBarElements[index].style.width = '100%';
                    progressBarElements[index].classList.add('bg-danger');
                } else {
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    element.textContent = `${days}h ${hours}j ${minutes}m ${seconds}d`;

                    const startTime = new Date(progressBarElements[index].getAttribute('data-start')).getTime();
                    const totalDuration = endTime - startTime;
                    const elapsedTime = now - startTime;
                    const progressPercentage = (elapsedTime / totalDuration) * 100;

                    progressBarElements[index].style.width = Math.min(progressPercentage, 100) + '%';

                    if (progressPercentage >= 100) {
                        progressBarElements[index].classList.add('bg-danger');
                    } else {
                        progressBarElements[index].classList.add('bg-success');
                    }
                }
            };

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    });
</script>

</body>
</html>
