@extends('layouts.app')

@section('content')

    <div>
        <section class="firm-content">
            <aside class="orange-section">
                <div>
                    <p>
                        <span>Careers</span>
                        Have You Got What it Takes?
                        <span class="small-size">Black Mountain Capital is constantly in search of the brightest talent to join our growing team</span>
                    </p>
                    <a href="#" class="btn-down"></a>
                </div>
            </aside>
        </section>

        <section class="loan-programs property">
            <div class="main">
                <span class="btn black">Career Opportunities</span>

                <div class="job-list-wr">
                    <div class="job-list">
                        @foreach($careers as $career)
                            <div class="js-job-list-item job-list__item">
                                <div class="job-list__inner">
                                    <div class="job-list__top">
                                        <h3 class="job-list__title">{{$career->title}}</h3>
                                        <div class="job-list__address">{{$career->location}}</div>
                                        <div class="job-list__salary">{{$career->salary}}</div>
                                    </div>

                                    <div class="js-job-list-desc job-list__desc-wr">
                                        <div class="job-list__desc">{!!$career->description!!}</div>

                                        <div class="job-list__responsibilities" style="margin-top: 20px;">
                                            <div class="job-list__responsibilities-item">{!!$career->responsibilities!!}</div>
                                        </div>
                                    </div>

                                    <div class="job-list__more">
                                        <a class="job-list__more-link" href="{{ route('job.detail', ['slug' => $career->id.'-'.strtolower(str_replace(' ', '-', $career->title))]) }}">See more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
