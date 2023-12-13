@extends('layouts.app')

@section('content')

<div>
    <section class="firm-content">
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
    </section>

    <section class="loan-programs property">
        <div class="main">
            <span class="btn black2">LOAN PROGRAMS</span>
           
            <div class="loan-list-wr">
                <div class="loan-list">
                @foreach($loanPrograms as $key => $loanProgram) 
                    <div class="loan-list__item">
                        <div class="loan-list__inner">
                           
                            <h3 class="loan-list__title">{{$loanProgram->title}}</h3>
                            <div class="loan-list__img">
                                <img src="/uploads/{{$loanProgram->img}}" alt="RESIDENTIAL">
                            </div>
                            <div class="loan-list__detail">
                                <div class="loan-list__desc">{!!$loanProgram->content!!}</div>
                                <div class="loan-list__actions">
                                    <button data-id="{{ $loanProgram->id }}"  class="js-open-question-form nbtn loan-list__apply" type="button">Learn More</button>
                                </div>
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
