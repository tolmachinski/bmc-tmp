<div class="page-home__content-item element--large element--large__mr">
    <figure class="page-home__content-item-figure">
        <img src="{{ "uploads/{$block->image}" }}" alt="{{ $block->title }}">
    </figure>
    <div class="page-home__content-item-text" style="padding-top: 40px;">
        <h3 class="item__title">{{ $block->title }}</h3>
        <div class="item__subtitle">{{ $block->address }}</div>
        <div class="item__text">
            {!! $block->content !!}
        </div>
        <div class="item__price">${{ number_format($block->price, 0, '.', ',') }}</div>
    </div>
</div>
