@extends('layouts.app')

@section('title', 'New York City Real Estate Private Equity Firm | Past Investments')
@section('description', 'Explore some of the successful investments managed by the Black Mountain Capital real estate private equity firm in New York City.')

@section('content')
<section class="page-transaction">
    <aside class="orange-section">
        <div>
            <p>
                <span>{{$sectionText->heading}}</span>
                {{$sectionText->line_1}}
                <span class="small-size">{{$sectionText->line_2}}</span>
            </p>
            <a href="#" class="btn-down"></a>
        </div>
    </aside>
    <div class="page-transaction-content">
        <span class="btn black" style="margin-bottom: 50px;">Transactions</span>
        <div class="page-transaction-content--wrapper">
            @foreach($transactions as $transaction)
                <div class="page-transaction-content__item">
                    <div class="page-transaction-content__item-title">{{$transaction->title}}</div>
                    <div class="page-transaction-content__item-subtitle">{!! $transaction->short !!}</div>
                    <div class="page-transaction-content__item-price">${{number_format($transaction->price, 0)}}</div>
                </div>
            @endforeach
                <div class="page-transaction-content__item" style="visibility: hidden;"></div>
                <div class="page-transaction-content__item" style="visibility: hidden;"></div>
                <div class="page-transaction-content__item" style="visibility: hidden;"></div>
        </div>
    </div>
</section>

@endsection
