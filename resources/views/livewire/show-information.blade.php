<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>PENGUMUMAN</h1>
                        <p class="mb-0">Pengumuman Terkait LP2M</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a wire:navigate href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Pengumuman</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->


    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Posts Section -->
                <section id="blog-posts" class="blog-posts section">

                    <div class="container">

                        <div class="row gy-4">
                            @foreach ($information as $item)
                                <div class="col-12">
                                    <article>

                                        <p class="title">
                                            <a>LP2M</a>
                                        </p>

                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-envelope"></i>
                                                    <a>No.
                                                        Surat: {{ $item->no_surat }}</a>
                                                </li>
                                                <li class="d-flex align-items-center"><i class="bi bi-calendar"></i>
                                                    <a>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="content">
                                            <h4>
                                                {{ $item->title }}
                                            </h4>

                                            <p>
                                                <a href="{{ asset('storage/' . $item->document) }}"
                                                    class="btn btn-sm btn-outline-primary" download>
                                                    <i class="bi bi-download me-1"></i> Unduh Dokumen
                                                </a>
                                            </p>

                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            @endforeach
                        </div><!-- End blog posts list -->

                    </div>

                </section><!-- /Blog Posts Section -->

                <!-- Blog Pagination Section -->
                <section id="blog-pagination" class="blog-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $information->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </section><!-- /Blog Pagination Section -->

            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">

                        <h3 class="widget-title">Informasi Terbaru</h3>
                        @foreach ($recentPosts as $post)
                            <div class="post-item mb-2 d-flex">
                                <div class="ms-2">
                                    <h4 style="font-size: 1rem;">
                                        <a wire:navigate
                                            href="#!">{{ $post->title }}</a>
                                    </h4>
                                    <time
                                        datetime="{{ $post->created_at->toDateString() }}">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}</time>
                                </div>
                            </div><!-- End recent post item-->
                        @endforeach

                    </div><!--/Recent Posts Widget -->


                </div>

            </div>

        </div>
    </div>
</main>
