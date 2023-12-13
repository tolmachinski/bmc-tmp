@extends('layouts.app')

@section('title', 'New York City Real Estate & Investment Banking | Mortgage Financing')
@section('description', 'Black Mountain Capital provides real estate financing and investment capital for New York homeowners, investors and developers.')

@section('content')
    <section class="firm-content firm-page">
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
        <div class="about-section">
            <span class="btn">{{$sectionText->heading}}</span>
            <p>{!! $sectionText->content !!}</p>
        </div>
        <div class="managment-section">
            <aside>
                <span class="btn">{{$managementSection->heading}}</span>
                <div class="inner">
                    @foreach($managementType1Records as $managementRecord)
                        @include('the-firm.management-item', ['record' => $managementRecord])
                    @endforeach
                </div>

                @for($i = 0; $i < count($managementType2Records); $i += 2)
                    <div class="inner two-col">
                        @include('the-firm.management-item', ['record' => $managementType2Records[$i]])

                        @if(isset($managementType2Records[$i + 1]))
                            @include('the-firm.management-item', ['record' => $managementType2Records[$i + 1]])
                        @else
                            <div style="background-color: transparent;"></div>
                        @endif
                    </div>
                @endfor
            </aside>
        </div>
    </section>
@endsection
