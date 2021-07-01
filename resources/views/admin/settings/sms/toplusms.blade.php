
@extends('admin.layouts.master')
@section('title', 'SMS Settings')

@section('head_style')
    <!-- bootstrap-toggle -->
    <link rel="stylesheet" href="{{ asset('public/backend/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">
@endsection

@section('page_content')
    <!-- Main content -->
    <div class="row">
        <div class="col-md-3 settings_bar_gap">
            @include('admin.common.settings_bar')
        </div>

        <div class="col-md-9">
            <div class="box box-info">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="tabs">
                        <li><a href="{{ url('admin/settings/sms/twilio') }}">Twilio</a></li>
                        <li ><a href="{{ url('admin/settings/sms/nexmo')}}">Nexmo</a></li>
                        <li class="active"><a href="{{ url('admin/settings/sms/toplusms')}}">Toplusms</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_1">
                            <div class="card">
                                <div class="card-header">
                                    <h4></h4>
                                </div>
                                <div class="container-fluid">
                                    <div class="tab-pane" id="tab_2">

                                        <form action="{{ url('admin/settings/sms/toplusms') }}" method="POST" class="form-horizontal" id="toplusms_sms_setting_form">
                                            {!! csrf_field() !!}

                                            <div class="box-body">

                                                <input type="hidden" name="type" value="{{ base64_encode($toplusms->type) }}">

                                                {{-- Name --}}
                                                <div class="form-group" style="display: none;">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <label class="col-md-3 control-label">Name</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="name" class="form-control"
                                                            value="{{ $toplusms->type == 'toplusms' ? 'toplusms' : '' }}" placeholder="Enter Sms Gateway Name" readonly>
                                                            @if ($errors->has('name'))
                                                                <span style="color:red;font-weight:bold;">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                {{-- Key --}}
                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <label class="col-md-3 control-label">Key</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="toplusms[Key]" class="form-control"
                                                            value="{{ isset($credentials->Key) ? $credentials->Key : '' }}" placeholder="Enter toplusms Key">
                                                            @if ($errors->has('toplusms.Key'))
                                                                <span style="color:red;font-weight:bold;">{{ $errors->first('toplusms.Key') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                {{-- Secret --}}
                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <label class="col-md-3 control-label">Id</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="toplusms[id]" class="form-control"
                                                            value="{{ isset($credentials->id) ? $credentials->id : '' }}" placeholder="Enter toplusms Id">
                                                            @if ($errors->has('toplusms.id'))
                                                                <span style="color:red;font-weight:bold;">{{ $errors->first('toplusms.id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                {{-- Secret --}}
                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <label class="col-md-3 control-label">Sender ID</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="toplusms[default_toplusms_sender]" class="form-control"
                                                            value="{{ isset($credentials->default_toplusms_sender) ? $credentials->default_toplusms_sender : '' }}" placeholder="Enter Sender ID">
                                                            @if ($errors->has('toplusms.default_toplusms_sender'))
                                                                <span style="color:red;font-weight:bold;">{{ $errors->first('toplusms.default_toplusms_sender') }}</span>
                                                            @endif
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                {{-- Status --}}
                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <label class="col-md-3 control-label">Status</label>
                                                        <div class="col-md-8">
                                                            <select name="status" class="select2 select2-hidden-accessible">
                                                                <option {{ $toplusms->status == 'Active' ? 'selected' : '' }} value="Active">Active</option>
                                                                <option {{ $toplusms->status == 'Inactive' ? 'selected' : '' }} value="Inactive">Inactive</option>
                                                            </select>
                                                            @if ($errors->has('status'))
                                                                <span style="color:red;font-weight:bold;">{{ $errors->first('status') }}</span>
                                                            @endif
                                                            <div class="clearfix"></div>
                                                            <h6 class="form-text text-muted"><strong>*Incoming SMS messages might be delayed by {{ ucfirst($toplusms->type) }}.</strong></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div style="margin-top:10px">
                                                        <a id="cancel_anchor" href="{{ url('admin/settings/sms/toplusms') }}" class="btn btn-danger btn-flat">Cancel</a>
                                                        <button type="submit" class="btn btn-primary pull-right btn-flat" id="sms-settings-toplusms-submit-btn">
                                                            <i class="fa fa-spinner fa-spin" style="display: none;"></i> <span id="sms-settings-toplusms-submit-btn-text">Update</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extra_body_scripts')

    <!-- jquery.validate -->
    <script src="{{ asset('public/dist/js/jquery.validate.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $(function () {
            $(".select2").select2({
            });
        });

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


        $('#toplusms_sms_setting_form').validate({
            rules: {
                "toplusms[Key]": {
                    required: true,
                },
                "toplusms[Secret]": {
                    required: true,
                },
                "toplusms[default_toplusms_sender]": {
                    required: true,
                },
            },
            messages: {
                "toplusms[Key]": {
                    required: "toplusms Key is required!",
                },
                "toplusms[Secret]": {
                    required: "toplusms Secret is required!",
                },
                "toplusms[default_toplusms_sender]": {
                    required: "toplusms Default Phone Number is required",
                },
            },
            submitHandler: function(form)
            {
                $("#sms-settings-toplusms-submit-btn").attr("disabled", true);
                $(".fa-spin").show();
                $("#sms-settings-toplusms-submit-btn-text").text('Updating...');
                $('#cancel_anchor').attr("disabled",true);
                $('#sms-settings-toplusms-submit-btn').click(false);
                form.submit();
            }
        });

    </script>
@endpush
