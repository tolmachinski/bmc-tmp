<div class="page-home__content-item element--small element--yellow">
    <div class="page-home__content-item-text page-home__content-item-text--3">
        <h3 class="item__title item__title--single item__title--single--white item__title--single__small">
            {!! $block->content !!}
        </h3>
        <div class="item__btn-wrapper">
            <a href="{{ $block->button_url }}" class="item__btn">{{ $block->button_title }}</a>
        </div>
    </div>
</div>
