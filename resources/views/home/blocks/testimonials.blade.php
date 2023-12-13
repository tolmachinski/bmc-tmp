<div class="page-home__content-item element--full">
    <div class="home-carousel owl-carousel owl-theme">
        @foreach($testimonials as $testimonial)
            @if(!empty($testimonial->description))
                <div class="owl-carousel__item">
                    <div class="owl-carousel__item-text">
                        {!! $testimonial->description !!}
                    </div>
                    <div class="owl-carousel__item-author">
                        @if(!empty($testimonial->author))
                            <span>{{ $testimonial->author }}</span>
                        @endif
                        @if(!empty($testimonial->position))
                            <br>{{ $testimonial->position }}
                        @endif
                        @if(!empty($testimonial->city))
                            <br>{{ $testimonial->city }}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
