<main>
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
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a wire:navigate href="{{ route('berita') }}">Berita</a></li>
                    <li class="current">Detail Berita</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <div class="post-img">
                                <img src="{{ asset('storage/' . $news->image) }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="title">{{ $news->title }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="#!">{{ $news->author }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#!">
                                            <time datetime="{{ $news->created_at->toDateString() }}">
                                                {{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}
                                            </time>
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                <p>
                                    {!! $news->content !!}
                                </p>
                            </div><!-- End post content -->

                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#!">{{ $news->category }}</a></li>
                                </ul>
                            </div><!-- End meta bottom -->

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->
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

</main>
