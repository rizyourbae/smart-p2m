<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SMART - P2M' }}</title>

    <!-- Favicons -->
    <link href="{{ asset('assets') }}/img/logo_uinsi.png" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets') }}/css/main.css" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a wire:navigate href=""{{route('home')}}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets') }}/img/logo_uinsi.png" alt="Logo UINSI" class="img-fluid">
                <h1 class="sitename">SMART-P2M</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a wire:navigate href="{{route('home')}}">Beranda<br></a></li>
                    <li><a wire:navigate href="{{route('tentang')}}">Tentang SMART-P2M</a></li>
                    <li><a wire:navigate href="{{route('pengumuman')}}">Pengumuman</a></li>
                    <li><a wire:navigate href="{{route('berita')}}">Berita</a></li>
                    <li class="dropdown"><a href="#"><span>Tautan</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="https://pddikti.kemdiktisaintek.go.id/">PDDIKTI</a></li>
                            <li><a href="https://sinta.kemdikbud.go.id/">SINTA</a></li>
                            <li><a href="https://litapdimas.kemenag.go.id/">LITAPDIMAS</a></li>
                            <li><a href="https://siladiktis.kemenag.go.id/">SILADIKTIS</a></li>
                            <li><a href="https://www.uinsi.ac.id/">UINSI</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Akses</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('filament.user.auth.login') }}">Dosen/Peneliti</a></li>
                            <li><a href="{{ route('filament.reviewer.auth.login') }}">Reviewer</a></li>
                        </ul>
                    </li>
                    <li><a wire:navigate href="{{route('kontak')}}">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <!-- <a class="btn-getstarted flex-md-shrink-0" href="{{ route('filament.user.auth.login') }}">LOGIN</a> -->
        </div>
    </header>
    <!-- End Header -->

    {{ $slot }}

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4></h4>
                        <p></p>

                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SMART-P2M</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Sistem Monitoring dan Administrasi Terpadu</p>
                        <p>Penelitian & Pengabdian Masyarakat</p>
                        <p class="mt-3"><strong>WA</strong> <span>+62 813 12345 5678</span></p>
                        <p><strong>Email:</strong> <span>uinsilp2m@test.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a wire:navigate href="{{route('home')}}">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a wire:navigate href="{{route('tentang')}}">Tentang SMART-P2M</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a wire:navigate href="{{route('pengumuman')}}">Pengumuman</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a wire:navigate href="{{route('faq')}}">FAQ</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Tautan</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="https://litapdimas.kemenag.go.id/">LITAPDIMAS</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="https://sinta.kemdikbud.go.id/">SINTA</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="https://siladiktis.kemenag.go.id/">SILADIKTIS</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="https://kemenag.go.id/">KEMENAG</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="https://www.uinsi.ac.id/">UINSI</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p></p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">LP2M</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                Designed by <a>TIPD 2025</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('assets') }}/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets') }}/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('assets') }}/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets') }}/js/main.js"></script>

    @livewireScripts
</body>

</html>
