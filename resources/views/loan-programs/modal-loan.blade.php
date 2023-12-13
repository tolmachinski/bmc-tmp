<div class="js-open-modal-wr open-modal-wr">
   <div class="open-modal">
        <span 
            class="js-open-modal-close open-modal__close"
        >x</span>

        <div class="js-open-modal-inner open-modal__inner">
                @if(isset($success) && $success === true)
                    <div class="success-block">
                        <h3 class="success-block__ttl">Thank you for your submission</h3>
                    </div>
                @else 
            <h3 class="open-modal__ttl">I have a question about this program?</h3>
               
            <form 
                method="POST"
                id="js-question-form" 
                class="open-modal__form"
                data-id="{{$currentProgram->id}}"
            >
                <div class="open-modal__inputs">
                    <label>Subject</label>
                    <select name="loan_id">
                    @foreach($loanPrograms as $key => $loanProgram) 
                        <option {{ $currentProgram->id === $loanProgram->id ? 'selected' : '' }} value="{{$loanProgram->id}}">{{$loanProgram->title}}</option>
                    @endforeach    
                    </select>
                        @if($errors->has('select'))
                            <div class="alert alert-danger">{{ $errors->first('select') }}</div>
                        @endif   
                    <input type="text" value="{{ isset($data['name']) ? $data['name'] : '' }}" name="name" placeholder="Name">
                        @if($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    <input type="text" value="{{ isset($data['email']) ? $data['email'] : '' }}" name="email" placeholder="Email">
                        @if($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    <input type="text" value="{{ isset($data['contact']) ? $data['contact'] : '' }}" name="contact" placeholder="Contact Number">
                        @if($errors->has('contact'))
                            <div class="alert alert-danger">{{ $errors->first('contact') }}</div>
                        @endif
                    <textarea name="question" placeholder="Question">{{ isset($data['question']) ? $data['question'] : '' }}</textarea> 
                        @if($errors->has('question'))
                            <div class="alert alert-danger">{{ $errors->first('question') }}</div>
                        @endif 
                    <div style="display:flex; justify-content: end; text-align:right">{!! htmlFormSnippet() !!}</div>

                        @if($errors->has(recaptchaFieldName()))
                            <div class="alert alert-danger">{{ $errors->first(recaptchaFieldName()) }}</div>
                        @endif   
                </div>

                <button  class="open-modal__apply nbtn" type="submit">SUBMIT</button>
            </form>
            @endif
        </div>
    </div>
</div>