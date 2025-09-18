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
                        <h1>BERITA</h1>
                        <p class="mb-0">Berita Seputar LP2M UINSI</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a wire:navigate href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Berita</li>
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
                            @foreach ($news as $item)
                                <div class="col-12">
                                    <article>
                                        <div class="post-img">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt=""
                                                class="img-fluid">
                                        </div>

                                        <h2 class="title">
                                            <a href="#">{{ $item->title }}</a>
                                        </h2>

                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                        href="#!">{{ $item->author }}</a></li>
                                                <li class="d-flex align-items-center"><i class="bi bi-calendar"></i>
                                                    <a>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</a>
                                                </li>
                                                <li class="d-flex align-items-center"><i class="bi bi-tag"></i> <a
                                                        href="#!">{{ $item->category }}</a></li>
                                            </ul>
                                        </div>

                                        <div class="content">
                                            <p>
                                                {!! Str::limit($item->content, 100) !!}
                                            </p>

                                            <div class="read-more">
                                                <a wire:navigate
                                                    href="{{ route('berita.detail', $item->id) }}">Selengkapnya</a>
                                            </div>
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
                        <div>
                            {{ $news->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </section><!-- /Blog Pagination Section -->

            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <!-- Categories Widget -->
                    <div class="categories-widget widget-item">

                        <h3 class="widget-title">Kategori</h3>
                        <ul class="mt-3">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#" wire:click.prevent="filterByCategory('{{ $category }}')"
                                        @if ($selectedCategory === $category) style="font-weight:bold" @endif>
                                        {{ $category }}
                                        <span>({{ \App\Models\News::where('category', $category)->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                            @if ($selectedCategory)
                                <li>
                                    <a href="#" wire:click.prevent="filterByCategory(null)">
                                        <em>Lihat Semua</em>
                                    </a>
                                </li>
                            @endif
                        </ul>

                    </div><!--/Categories Widget -->

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">

                        <h3 class="widget-title">Berita Terbaru</h3>
                        @foreach ($recentPosts as $post)
                            <div class="post-item mb-2 d-flex">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="flex-shrink-0" style="width:60px;height:60px;object-fit:cover;">
                                <div class="ms-2">
                                    <h4 style="font-size: 1rem;">
                                        <a wire:navigate
                                            href="{{ route('berita.detail', $post->id) }}">{{ $post->title }}</a>
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
