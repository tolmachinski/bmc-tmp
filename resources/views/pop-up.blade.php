<div class="js-applay-modal-wr applay-modal-wr">
            
   <div class="applay-modal">
        <span 
            class="js-applay-modal-close applay-modal__close"
            @if(isset($success) && $success === true)
                data-page-redirect="jobs-page"
            @endif
        >x</span>

        <div class="js-applay-modal-inner applay-modal__inner">
            @if(isset($success) && $success === true)
                <div class="success-block">
                    <h3 class="success-block__ttl">Thank you for your submission</h3>
                    <p class="success-block__txt">Your application has been received and is being processed by our hiring specialists. If you are a good match for our organization, we will reach out to you.</p>
                </div>
            @else
                <h3 class="applay-modal__position">{{$career->title}}</h3>
                <div class="applay-modal__address">{{$career->location}}</div>
                <div class="applay-modal__salary">Salary is based on Exp <br> Comm structure up to {{$career->salary}}</div>
                <div class="applay-modal__form-info">To Apply for this position, please provide the details below and attach your resume for our review:</div>
                <form id="js-apply-job-form" class="applay-modal__form" data-id="{{$career->id }}">
                    <div class="applay-modal__inputs">
                        <input type="text" value="{{ isset($data['name']) ? $data['name'] : '' }}" name="name" placeholder="Enter Your Full Name">
                        @if($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif

                        <input type="text" value="{{ isset($data['email']) ? $data['email'] : '' }}" name="email" placeholder="Enter Email Address">
                        @if($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif

                        <input type="text" value="{{ isset($data['contact']) ? $data['contact'] : '' }}" name="contact" placeholder="Enter Contact Number">
                        @if($errors->has('contact'))
                            <div class="alert alert-danger">{{ $errors->first('contact') }}</div>
                        @endif

                        <textarea name="remarks" placeholder="Enter Your Remarks">{{ isset($data['remarks']) ? $data['remarks'] : '' }}</textarea>
                        @if($errors->has('remarks'))
                            <div class="alert alert-danger">{{ $errors->first('remarks') }}</div>
                        @endif
                    </div>

                    <div class="js-file-drop-area file-drop-area">
                        <span class="js-file-msg file-drop-area__file-msg">Drag and drop resume files here or</span>
                        <span class="file-drop-area__fake-btn nbtn">+ ADD FILE</span>
                        <input class="js-file-input file-drop-area__file-input" type="file" name="document" accept=".pdf">
                    </div>
                    <div class="js-file-drop-area-accept file-drop-area__accept">.doc, .pdf, txt formats only</div>
                    <div class="js-file-drop-area-error"></div>
                        @if($errors->has('document'))
                            <div class="alert alert-danger">{{ $errors->first('document') }}</div>
                        @endif
                    <div style="display:flex; justify-content: end; text-align:right">{!! htmlFormSnippet() !!}</div>

                        @if($errors->has(recaptchaFieldName()))
                            <div class="alert alert-danger">{{ $errors->first(recaptchaFieldName()) }}</div>
                        @endif   

                    <button class="applay-modal__apply nbtn" type="submit">SUBMIT APPLICATION</button>
                </form>
                <p class="applay-modal__txt">BMC is an Equal Opportunity Employer. We’re dedicated to creating a positive workplace environment, which means ensuring that we offer a comprehensive suite of benefits to promote health and financial security for employees and their families. BMC offers a variety of options for health, dental, vision and other coverage, in addition to a 401(k) program.</p>
            @endif
        </div>
    </div>
</div>
