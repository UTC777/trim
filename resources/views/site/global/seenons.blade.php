<!-- Start Seen On Area -->
<div class="partner-area bg-color ptb-100">
    <div class="container">
        <div class="partner-bg">
            <div class="row">
                <div class="section-title">
                    <h2>As Seen On</h2>
                </div>
                <div class="partner-slider owl-carousel owl-theme">
                    @foreach ($seenons as $seenon)
                        <div class="partner-item">
                            <a href="#">
                                @if ($seenon->featured_image)
                                    <img src="{{ $seenon->featured_image->getUrl() }}" alt="Image">
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Seen On Area -->