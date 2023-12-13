<div class="page-home__content-item element--small">
    <div class="page-home__content-item-text page-home__content-item-text--5">
        <h3 class="item__title item__title">
            {{ $block->title }}
        </h3>
        <div class="item__text item__text--medium">
            {!! $block->content !!}
        </div>
        <a href="{{ $block->button_url }}" class="item__btn">{{ $block->button_title }}</a>
    </div>
</div>
