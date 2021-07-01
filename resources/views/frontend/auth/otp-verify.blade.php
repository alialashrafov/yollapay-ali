@extends('frontend.layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/intl-tel-input-13.0.0/build/css/intlTelInput.css')}}">
@endsection

@section('content')

<!--Start banner Section-->
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>@lang('message.registration.two-step-verificarion')</h1>
            </div>
        </div>
    </div>
</section>
<!--End banner Section-->

<!--Start Section-->
<section class="section-01 sign-up padding-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <!-- form card login -->
                        <div class="card rounded-0">
                            <div class="card-header">
                                <h3 class="mb-0">@lang('message.form.button.verify-otp')</h3>
                            </div>

                            <div class="card-body">
                                @include('frontend.layouts.common.alert')
                                <br>

                                <form action="{{ url('verification/otp') }}" class="form-horizontal" id="register_form" method="POST">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="user_uid" value="{{$userUid}}">
                                    <div class="form-group">
                                        <label for="inputOtp">@lang('message.registration.otp')<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="otp" name="otp" value="{{old('otp')}}">
                                        @if($errors->has('otp'))
                                        <span class="error">
                                            {{ $errors->first('otp') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mt20">
                                            <button type="submit" class="btn btn-cust" id="users_create"><i class="spinner fa fa-spinner fa-spin" style="display: none;"></i> <span id="users_create_text">@lang('message.form.button.verify-otp')</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--/card-block-->
                        </div>
                        <!-- /form card login -->
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
</section>
@endsection

@section('js')
<script src="{{asset('public/frontend/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}" type="text/javascript"></script>
<!-- isValidPhoneNumber -->
<script src="{{ asset('public/frontend/js/isValidPhoneNumber.js') }}" type="text/javascript"></script>

<script>
    // flag for button disable/enable
    var hasPhoneError = false;
    var hasEmailError = false;

        //jquery validation
    $.validator.setDefaults({
    highlight: function(element) {
        $(element).parent('div').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parent('div').removeClass('has-error');
    },
    errorPlacement: function (error, element) {
            error.insertAfter(element);
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "{{__('This field is required.')}}",
        email: "{{__("Please enter a valid email address.")}}",
        equalTo: "{{__("Please enter the same value again.")}}",
        minlength: $.validator.format( "{{__("Please enter at least")}}"+" {0} "+"{{__("characters.")}}" ),
        password_confirmation: {
            equalTo: "{{__("Please enter same value as the password field!")}}",
        },
    })

    $('#register_form').validate({
        rules: {
            otp: {
                required: true,
            },
        },
        messages: {
            password_confirmation: {
                equalTo: "{{__("Please enter same value as the password field!")}}",
            },
        },
        submitHandler: function(form)
        {
            $("#users_create").attr("disabled", true).click(function (e)
            {
                e.preventDefault();
            });
            $(".spinner").show();
            $("#users_create_text").text("{{__('Signing Up...')}}");
            form.submit();
        }
    });

    /**
    * [check submit button should be disabled or not]
    * @return {void}
    */
    function enableDisableButton()
    {
        if (!hasPhoneError && !hasEmailError) {
            $('form').find("button[type='submit']").prop('disabled',false);
        } else {
            $('form').find("button[type='submit']").prop('disabled',true);
        }
    }

</script>
@endsection
