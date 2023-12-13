@extends('layouts.app')

@section('title', 'New York City Real Estate Lending & Banking Services | Press & News')
@section('description', 'Find out the latest news from Black Mountain Capital, a leading banking and real estate lending service in New York City!')

@section('content')
    <style>
        .grid-after::after {
            content: "";
            width: 32%;
        }
    </style>

<section class="page-press">
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
    <div class="page-press__content">
        <span class="btn black" style="margin-bottom: 50px;">Press</span>
        <div class="page-press__content-wrapper grid-after">
            @foreach($presses as $press)
                <a href="@if($press->format == "pdf")
                @if(!empty($press->pdf))
                        /uploads/{{ $press->pdf }}
                @else # @endif
                @else
                @if(!empty($press->url))
                {{ $press->url }}
                @else # @endif
                @endif" target="_blank" class="page-press__content-item">
                    <div class="item__text-wrapper">
                        <h3 class="item__title" title="{{$press->title}}">{{$press->title}}</h3>
                        <div class="item__subtitle">{{date('F d, Y', strtotime($press->date))}}</div>
                    </div>
                    <div class="item__bottom-wrapper">
                        <img src="/uploads/{{$press->img}}" alt="{{$press->title}}">
                        <div class="button-wrapper">
                            <span class="item__btn">
                                Read More
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
