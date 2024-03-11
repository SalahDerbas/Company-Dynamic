@extends('frontEnd.layouts.app')

@section('content')
<!--Banner Start-->
<div class="banner-slider" style="background-image: url({{ asset('upload/'.$setting->banner_service) }})">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1>{{ $service->name }}</h1>
        </div>
    </div>
</div>
<!--Banner End--> 

<!--Single-Service Start-->
<div class="single-service-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="service-info">
                    <div class="single-ser-carousel owl-carousel">
                        <div class="event-photo-item">
                            <img src="{{ asset('upload/'.$service->photo) }}" alt="Service Photo">
                        </div>
                    </div>
                    <h2>{{ $service->name }}</h2>
                    {!! clean($service->description) !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-sidebar">
                    <div class="service-sidebar-item headstyle">
                        <h4>{{ SIDEBAR_SERVICE_HEADING_1 }}</h4>
                        <ul>
                            @foreach($services as $data)
                                <li><a href="{{ route('service.view',$data->slug) }}"><i class="fas fa-chevron-right"></i> {{ $data->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="service-sidebar-item headstyle">
                        <h4>{{ SIDEBAR_SERVICE_HEADING_2 }}</h4>
                        <form method="POST" action="{{ route('service.send.email') }}" class="form_contact_ajax">
                            @csrf
                            
                            <div class="form-row">
                                <input type="hidden" name="service" value="{{ $service->name }}">
                                <input type="hidden" name="slug" value="{{ $service->slug }}">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ NAME }}" name="name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="{{ EMAIL_ADDRESS }}" name="email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ PHONE_NUMBER }}" name="phone">
                                    <span class="text-danger error-text phone_error"></span>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="{{ MESSAGE }}" name="message"></textarea>
                                    <span class="text-danger error-text message_error"></span>
                                </div>
                                @php
                                  $setting = \App\Models\Setting::orderBy('id','desc')->first();
                                @endphp
                                @if($setting->google_recaptcha_status == 'Show')
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ $setting->google_recaptcha_key }}"></div>
                                    <span class="text-danger error-text g-recaptcha-response_error"></span>
                                </div>
                                @endif
                                <div class="form-button">
                                    <button type="submit" class="btn" name="form_service">{{ SUBMIT }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Single-Service End-->
@endsection

@push('js')
<script>
    (function($){
        $(".form_contact_ajax").on('submit', function(e){
            e.preventDefault();
            $('#loader').show();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data)
                {
                    $('#loader').hide();
                    if(data.code == 0)
                    {
                        $.each(data.error_message, function(prefix, val) {
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                    else if(data.code == 1)
                    {
                        $(form)[0].reset();
                        grecaptcha.reset();

                        let Msg = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500
                        })

                        Msg.fire({
                          type: 'success',
                          title: data.success_message,
                        })
                        
                    }
                    else 
                    {
                        $(form)[0].reset();
                        grecaptcha.reset();

                        let Msg = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        })

                        Msg.fire({
                          type: 'error',
                          title: data.success_message,
                        })
                    }
                }
            });
        });
    })(jQuery);
</script>
@endpush