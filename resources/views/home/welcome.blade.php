@extends('layouts.app')

@section('title', 'New York City Mortgage Banking | Real Estate & Investment Loans')
@section('description', 'Black Mountain Capitals\' mortgage banking experts secure real estate loans and financing for investors, and property owners.')

@section('content')
<section class="section1">
    <div class="container-center section1__inner">
        <div class="section1__info">
            <h1 class="section1__title">
                A Private Mortgage <br>
                Banking Company
            </h1>
            <a href="/the-firm" class="learn">
                Learn more
            </a>
        </div>

        @include('home.daily-rates', ['snapshot' => $rateSnapshot, 'today' => $today])
    </div>
</section>

<section class="home-section-2">
    <p>
        Black Mountain Capital has over 25 years of <br>
        Real Estate &amp; <strong>Private</strong> Mortgage Banking Experience
    </p>

    <a href="/transactions">
        Learn more
    </a>
</section>

<section class="page-home">
    <div class="container-center-sm">
        <div class="page-home__content">
            @foreach($blocks['banner'] as $block)
                @include("home.blocks.{$block->type}", ['block' => $block])
            @endforeach

            @foreach($blocks['top'] as $block)
                @include("home.blocks.{$block->type}", ['block' => $block, 'featuredTransactions' => $featuredTransactions])
            @endforeach

            @foreach($blocks['center'] as $block)
                @include("home.blocks.{$block->type}", ['block' => $block])
            @endforeach

            @include('home.blocks.testimonials', ['testimonials' => $testimonials])

            {{--@foreach($blocks['bottom'] as $block)
                @include("home.blocks.{$block->type}", ['block' => $block])
            @endforeach--}}

            {{-- <div class="page-home__content-item element--large element--large__mr">
                <figure class="page-home__content-item-figure">
                    <img src="assets/images/apart_1.png" alt="">
                </figure>
                <div class="page-home__content-item-text">
                    <h3 class="item__title">Highlighted Transaction</h3>
                    <div class="item__subtitle">New York, NY</div>
                    <div class="item__text">
                        Delayed Condo Project with Existing Loan Maturing. Closed in 2 weeks.
                        <br> 65% LTV.
                    </div>
                    <div class="item__price">$9,400,000</div>
                </div>
            </div>
            <div class="page-home__content-item element--small element--small__mr element--yellow">
                <div class="page-home__content-item-text page-home__content-item-text--2">
                    <h3 class="item__title item__title--single">
                        <b>Black Mountain Capital has over 25 years of Real Estate & Mortgage Banking experience.</b>
                    </h3>
                    <a href="#" class="item__btn">Learn More</a>
                </div>
            </div>
            <div class="page-home__content-item element--small element--yellow">
                <div class="page-home__content-item-text page-home__content-item-text--3">
                    <h3 class="item__title item__title--single item__title--single--white item__title--single__small">
                        <b>We work with Investors, Realtors & Brokers</b> to secure the most advantageous financing options for various
                        types of real estate based transactions.
                    </h3>
                    <a href="#" class="item__btn">View More</a>
                </div>
            </div>
            <div class="page-home__content-item element--large element--large__ml">
                <figure class="page-home__content-item-figure">
                    <img src="assets/images/man.png" alt="">
                </figure>
                <div class="page-home__content-item-text page-home__content-item-text--4">
                    <h3 class="item__title item__title--medium">
                        Alex talks success through repeat clients and word of mouth.
                    </h3>
                    <div class="item__text item__text--small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam,
                        massa lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet,
                        tristique et sapien. Fusce pretium aliquam aliquam.
                    </div>
                    <a href="#" class="item__btn">Read More</a>
                </div>
            </div>
            <div class="page-home__content-item element--large element--large__mr">
                <div class="owl-carousel owl-theme">
                    <div class="owl-carousel__item">
                        <div class="owl-carousel__item-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam,
                            massa lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet,
                            tristique et sapien. Fusce pretium aliquam aliquam. Mauris blandit pellentesque mattis. Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam, massa
                            lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet, tristique
                            et sapien. Fusce pretium aliquam aliquam. Mauris blandit pellentesque mattis. Duis tincidunt, mi sit amet consequat
                            aliquam, massa lorem pulvinar justo, et tempor tortor nunc vel dui.
                        </div>
                        <div class="owl-carousel__item-author">
                            <span>Jade Scally,</span>
                            <br>CEO PieCo
                        </div>
                    </div>
                    <div class="owl-carousel__item">
                        <div class="owl-carousel__item-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam,
                            massa lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet,
                            tristique et sapien. Fusce pretium aliquam aliquam. Mauris blandit pellentesque mattis. Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam, massa
                            lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet, tristique
                            et sapien. Fusce pretium aliquam aliquam. Mauris blandit pellentesque mattis. Duis tincidunt, mi sit amet consequat
                            aliquam, massa lorem pulvinar justo, et tempor tortor nunc vel dui.
                        </div>
                        <div class="owl-carousel__item-author">
                            <span>Jade Scally,</span>
                            <br>CEO PieCo
                        </div>
                    </div>
                    <div class="owl-carousel__item">
                        <div class="owl-carousel__item-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam,
                            massa lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet,
                            tristique et sapien. Fusce pretium aliquam aliquam. Mauris blandit pellentesque mattis. Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit. Sed pharetra mi ipsum. Duis tincidunt, mi sit amet consequat aliquam, massa
                            lorem pulvinar justo, et tempor tortor nunc vel dui. Maecenas nisl eros, faucibus in molestie sit amet, tristique
                            et sapien. Fusce pretium aliquam aliquam. Mauris blandit pellentesque mattis. Duis tincidunt, mi sit amet consequat
                            aliquam, massa lorem pulvinar justo, et tempor tortor nunc vel dui.
                        </div>
                        <div class="owl-carousel__item-author">
                            <span>Jade Scally,</span>
                            <br>CEO PieCo
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-home__content-item element--small">
                <div class="page-home__content-item-text page-home__content-item-text--5">
                    <h3 class="item__title item__title">
                        Financing For:
                    </h3>
                    <div class="item__text item__text--medium">
                        Acquisitions & Development, Business, Construction, Foreign Nationals, Not for Profits, Industrial, Investment Opportunities,
                        Land Loans, Mixed Use, Multi Family, No Income, Private Capital, Rehab, Retail & Office, Single Tenant, Owner
                        Occupied, COOP Buildings, Faith Based, HOA Condos, Hotel/Motel and much more.
                    </div>
                    <a href="#" class="item__btn">View More</a>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection
