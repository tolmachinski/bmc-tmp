@extends('layouts.app')

@section('content')

<section class="header-min-block">
    <aside class="header-min-block__inner">
        <h1 class="header-min-block__ttl">Careers</h1>
    </aside>
</section>

<div class="container">
    <div class="container-center-sm">
        <div class="main-content-wr">
            <div class="main-content">
                <div class="bradcrumbs">
                    <a class="bradcrumbs__item" href="/job">< Back</a>
                </div>
                
                <div class="job-detail">
                    <div class="job-detail__top">
                        <div class="job-detail__top-left">
                            <h3 class="job-detail__title">{{$career->title }}</h3>
                            <div class="job-detail__address">{{$career->location }}</div>
                            <div class="job-detail__salary">{{$career->salary }}</div>
                        </div>
                        <div class="job-detail__top-right">
                             <div class="job-detail__additional-txt">{{$career->created_at->diffForHumans() }}</div>   
                             <div class="job-detail__additional-txt">Full Time</div>   
                        </div>
                    </div>

                    <button class="job-detail__apply nbtn js-open-applay-modal" data-id="{{ $career->id }}" type="button">Apply</button>

                    <div class="job-detail__desc-ttl">Job Description</div>
                    <div class="job-detail__desc">{!!$career->description !!}</div>
                    
                    <div class="job-detail__responsibilities">
                        <div class="job-detail__responsibilities-item">{!!$career->responsibilities!!}</div>
                    </div>

                    <button 
                        class="js-open-applay-modal job-detail__apply nbtn" 
                        data-id="{{ $career->id }}" 
                        type="button"
                    >apply</button>
                </div>
            </div>      
            <div class="main-content-sidebar">
                <div class="about-firm">
                    <div class="about-firm__img">
                        <img width="135" height="73" src="/images/logo-header.png" alt="Black Mountain Capital Logo"/>
                    </div>
                    <div class="about-firm__ttl">About The Firm</div>
                    <div class="about-firm__ttl">Black Mountain Capital is a Real Estate and Business banking firm with over 25 years of lending experience.</div>
                    <div class="about-firm__desc">BMC is the industry's premier capital firm that provides deep industry knowledge and access to a pool of capital options and partnerships. Years of experience have enabled BMC to become a valued business partner that is familiar with all aspects of today's credit challenges. BMC's main focus is innovative deal origination, creative structuring, equity investing and providing capital. This is done with in-house experts. Our everyday market experience enables us to customize financing options for traditional and non-traditional types of situations. BMC is able to create and execute quick-to-close transactions regardless of size, location or complexity. All of these segments reflect BMC's strong partnership culture, commitment to steady performance and uncompromising integrity. BMC is committed to delivering the highest level of client service.</div>
                </div>
            </div> 
        </div>
             

        
        
    </div>
</div>
@endsection
