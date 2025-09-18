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

    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>F.A.Q</h2>
            <p>Frequently Asked Questions</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row">
                @php
                    $chunks = $faqs->chunk(ceil($faqs->count() / 2));
                @endphp
                <div class="row">
                    @foreach ($chunks as $chunkIndex => $chunk)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ 100 + $chunkIndex * 100 }}">
                            <div class="faq-container">
                                @foreach ($chunk as $faq)
                                    <div
                                        class="faq-item{{ $loop->parent->first && $loop->first ? ' faq-active' : '' }}">
                                        <h3>{{ $faq->question }}</h3>
                                        <div class="faq-content">
                                            <p>{!! $faq->answer !!}</p>
                                        </div>
                                        <i class="faq-toggle bi bi-chevron-right"></i>
                                    </div><!-- End Faq item-->
                                @endforeach
                            </div>
                        </div><!-- End Faq Column-->
                    @endforeach
                </div>
            </div>

        </div>

    </section><!-- /Faq Section -->
</main>
