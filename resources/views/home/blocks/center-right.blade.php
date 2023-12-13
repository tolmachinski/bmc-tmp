<div class="page-home__content-item element--large element--large__ml">
    <figure class="page-home__content-item-figure" style="padding: 1.25rem;">
        <img src="{{ "uploads/{$block->image}" }}" alt="{{ $block->title }}">
    </figure>
    <div class="page-home__content-item-text page-home__content-item-text--4">
{{--        <h3 class="item__title item__title--medium">--}}
{{--            {{ $block->title }}--}}
{{--        </h3>--}}
        <div class="item__text item__text--small">
            {!! $block->content !!}
        </div>
        <div>
            <a href="{{ $block->button_url }}" class="item__btn">{{ $block->button_title }}</a>
        </div>
    </div>
</div>
