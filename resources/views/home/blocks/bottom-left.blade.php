<div class="page-home__content-item element--large element--large__mr">
    <h3 class="item__title">
        What our Clients say about us
    </h3>
    <div class="owl-carousel owl-theme">
        @foreach($block->calculated as $part) 
            @if(!empty($part['text']))
                <div class="owl-carousel__item">
                    <div class="owl-carousel__item-text">
                        {!! $part['text'] !!}
                    </div>
                    <div class="owl-carousel__item-author">
                        @if(!empty($part['author']))
                            <span>{{ $part['author'] }},</span>
                        @endif
                        @if(!empty($part['position']))
                            <br>{{ $part['position'] }}
                        @endif
                        @if(!empty($part['address']))
                            <br>{{ $part['address'] }}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
