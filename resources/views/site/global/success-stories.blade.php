		<!-- Start Customer Story Area -->
		<section class="customer-story-area bg-color">
			<div class="container">
				<div class="section-title">
					<span>Customer Story</span>
					<h2>Real Success Stories</h2>
					<p>*The testimonials are from real-life patients. Name kept confidential by request. Signed statements attesting to the validity on file. Individual results may vary.
                    </p>
				</div>

				<div class="customer-story-slider owl-carousel owl-theme eq-height-wrap">
                    @foreach ($success_stories as $story)
                        <div class="single-customer-story eqheight">
                            @if($story->use_before_after && $story->hasMedia('before') && $story->hasMedia('after'))
                                <a href="{{ route('success-stories.show',$story->slug) }}" class="single-portfolio d-flex justify-content-between">
                                    <div class="col-lg-6 col-md-6 p-1">
                                        <img src="{{ $story->getFirstMediaUrl('before', 'responsive') }}" alt="Before" style="width: 100%;">
                                    </div>
                                    <div class="col-lg-6 col-md-6 p-1">
                                        <img src="{{ $story->getFirstMediaUrl('after', 'responsive') }}" alt="After" style="width: 100%;">
                                    </div>
                                </a>
                            @elseif($story->use_combined && $story->hasMedia('combined'))
                                <div class="col-lg-12 col-md-12">
                                    <a href="{{ route('success-stories.show',$story->slug) }}" class="single-portfolio d-flex justify-content-center" style="padding: 20px;">
                                        <img src="{{ $story->getFirstMediaUrl('combined', 'responsive') }}" alt="Combined" style="max-width: 100%; height: auto;">
                                    </a>
                                </div>
                            @else
                                <div class="col-lg-12 col-md-12">
                                    <a href="{{ route('success-stories.show',$story->slug) }}" class="single-portfolio">
                                        <!-- Placeholder or message indicating no images are selected/displayed -->
                                        {{-- <p>No images available</p> --}}
                                        <img src="{{ asset('site/assets/images/No_Image_Available.jpg') }}" alt="No images available" style="max-width: 100%; height: auto;">
                                    </a>
                                </div>
                            @endif

                            <h2>{{ $story->title ?? '' }}</h2>
                            <div>{!! $story->story ?? '' !!}</div>
                        </div>
                    @endforeach
				</div>
			</div>
		</section>
		<!-- End Customer Story Area -->
