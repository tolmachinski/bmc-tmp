@extends('layouts.app')

@section('content')

<section class="firm-content">
    <aside class="orange-section height-auto">
        <div>
            <p>
                <span>{{$sectionText->heading}}</span>
                {{$sectionText->line_1}}
                <span class="small-size">{{$sectionText->line_2}}</span>
            </p>
            <span class="small-size">{!! $sectionText->content !!}</span>
        </div>
    </aside>

</section>

@endsection
