<div class="market">
    <div class="top">
        <span><img src="images/logotyp.png" alt="logotyp"></span>
        <h2>Market Snapshot</h2>
    </div>
    <main>
        <span class="market__date">{{ strtoupper($today->format('l F d, Y')) }}</span>
        @if($snapshot->count())
            <ul>
                @foreach($snapshot as $dailyRate)
                    <li>
                        <h3>{{ $dailyRate->rate->label }}</h3>
                        <span>{{ $dailyRate->change >= 0 ? '+' : '' }}{{ $dailyRate->change }}%</span>
                        <p>{{ $dailyRate->last }}%</p>
                    </li>
                @endforeach
            </ul>
    
            <p class="info">
                This data is provided by TheFinancials.com for reference.
            </p>
        @else 
            <p class="info">
                No rates for today found
            </p>
        @endif
    </main>
</div>
