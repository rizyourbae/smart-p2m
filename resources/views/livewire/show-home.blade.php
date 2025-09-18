<main>
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Selamat Datang di Aplikasi SMART-P2M</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Sistem Monitoring dan Administrasi Terpadu Penelitian &
                        Pengabdian Masyarakat</p>
                    <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('filament.user.auth.login') }}" class="btn-get-started">Ajukan Usulan <i
                                class="bi bi-arrow-right"></i></a>
                        <a href="https://www.youtube.com/watch?v=UpRX-qerGP8&ab_channel=UINSISamarinda"
                            class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="assets/img/hero-riset.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->
    <!-- End Hero Section -->

    <!-- ======= Status Section ======= -->
    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-center">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-people-fill color-blue flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $reviewerCount }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Reviewer</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-person-fill color-orange flex-shrink-0" style="color: #ee6c20;"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $lecturerCount }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Peneliti</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-journal-richtext color-green flex-shrink-0" style="color: #15be56;"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $proposalCount }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Proposal</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->
    <!-- End Status Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Berita Terbaru</h2>
            <p>Berita terbaru mengenai penelitian dan pengabdian masyarakat</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">
                @foreach ($recentNews as $news)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid"
                                    alt="{{ $news->title }}" style="width:350px; height:200px; object-fit:cover;">
                                <span
                                    class="post-date">{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}</span>
                            </div>

                            <div class="post-content d-flex flex-column">

                                <h3 class="post-title">{{ $news->title }}</h3>

                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i> <span class="ps-2">{{ $news->author }}</span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i> <span class="ps-2">{{ $news->category }}</span>
                                    </div>
                                </div>

                                <hr>

                                <a wire:navigate wire:navigate href="{{ route('berita.detail', $news->id) }}"
                                    class="readmore stretched-link"><span>Selengkapnya</span><i
                                        class="bi bi-arrow-right"></i></a>

                            </div>

                        </div>
                    </div><!-- End post item -->
                @endforeach
            </div>

        </div>

    </section><!-- /Recent Posts Section -->
    <!-- End Recent Posts Section -->

    <!-- ======= Pengumuman Section ======= -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Pengumuman Terbaru</h2>
            <p>Pengumuman Terbaru terkait dengan aturan maupun informasi Penelitian dan Pengabdian kepada Masyarakat.
            </p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">
                @foreach ($recentInformation as $information)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100"
                            style="min-height: 400px;">
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $information->no_surat }}</h3>
                                <p class="text-muted" style="font-size: 14px;">
                                    {{ $information->title }}
                                </p>
                                <div class="mt-3">
                                    @if ($information->document)
                                        <a href="{{ asset('storage/' . $information->document) }}"
                                            class="btn btn-sm btn-outline-primary" download>
                                            <i class="bi bi-download me-1"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada dokumen</span>
                                    @endif
                                </div>
                                <div class="meta d-flex align-items-center mt-auto">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar"></i>
                                        <span class="ps-2">
                                            {{ \Carbon\Carbon::parse($information->created_at)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div><!-- End post item -->
                @endforeach
            </div>

        </div>

    </section><!-- /Pengumuman Section -->
    <!-- End Pengumuman Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Bagaimana Kami Bekerja</h2>
            <p>SMART-P2M memiliki fitur-fitur yang mudah digunakan untuk membantu Anda mengatur dan mengontrol akun Anda
                secara online.<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-cyan position-relative">
                        <i class="bi bi-cloud-download-fill icon"></i>
                        <h3>Usulan Proposal Penelitian dan Pengabdian kepada Masyarakat</h3>
                        <p>Dosen membuat Usulan Proposal Penelitian dan Pengabdian kepada Masyarakat untuk diajukan
                            kepada LP2M.</p>
                        <a> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-orange position-relative">
                        <i class="bi bi-sliders2-vertical icon"></i>
                        <h3>Review Usulan Proposal</h3>
                        <p>Usulan Proposal Penelitian dan Pengabdian kepada Masyarakat dinilai oleh Reviewer LP2M.</p>
                        <a><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-teal position-relative">
                        <i class="bi bi-clipboard-check icon"></i>
                        <h3>Laporan Pelaksanaan Kegiatan</h3>
                        <p>Laporan pelaksanaan Kegiatan Proposal Penelitian dan Pengabdian kepada Masyarakat yang
                            didanai tercatat dengan baik.</p>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->

</main>
