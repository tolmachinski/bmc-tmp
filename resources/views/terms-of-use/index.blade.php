@extends('layouts.app')

@section('content')

{{--<section class="firm-content">--}}
    {{--<aside class="orange-section">--}}
        {{--<div>--}}
            {{--<p>--}}
                {{--<span>{{$sectionText->heading}}</span>--}}
                {{--{{$sectionText->line_1}}--}}
                {{--<span class="small-size">{{$sectionText->line_2}}</span>--}}
            {{--</p>--}}
            {{--<a href="#" class="btn-down"></a>--}}
        {{--</div>--}}
    {{--</aside>--}}

{{--</section>--}}
<section>
    <aside class="orange-section height-auto">
        <div>
            <p>
                <span>{{$sectionText->heading}}</span>
                {{$sectionText->line_1}}
                <span class="small-size">{!! $sectionText->content !!}</span>
            </p>
        </div>
    </aside>

</section>

@endsection