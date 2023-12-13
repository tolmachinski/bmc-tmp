<div class="home-transaction-title">
    Highlighted Transactions
</div>

<div class="element--full home-transaction-wrapper">
    @foreach($featuredTransactions as $transaction)
        <div class="page-transaction-content__item page-transaction-content__item--home-transaction">
            <div class="page-transaction-content__item-title">{{$transaction->title}}</div>
            <div class="page-transaction-content__item-subtitle">{!! $transaction->short !!}</div>
            <div class="page-transaction-content__item-price">${{number_format($transaction->price, 0)}}</div>
        </div>
    @endforeach
</div>
