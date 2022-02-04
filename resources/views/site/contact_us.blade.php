@extends('layouts.main')

@section('content')
<!--main content-->
<!--breadcrumb-->
<div class="breadcrumb-contact">
    <div class="container">
        <div class="breadcrumb_title" data-aos="fade-right">Contact Us</div>
        <div class="bread-crumb right-side" data-aos="fade-left">
            <ul>
                <li><a href="{{route('/')}}">HOME</a>/</li>
                <li><span>CONTACT US</span></li>
            </ul>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div class="contact-info-body">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-sm-4">
                <div class="address-item">
                    <div class="icon-part">
                        <img src="{{ URL::asset('public/frontend/images/1.png') }}" alt="">
                    </div>
                    <div class="address-text"> <span class="label">Address</span>
                        <span class="des">{{$model[0]->value}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="address-item">
                    <div class="icon-part">
                        <img src="{{ URL::asset('public/frontend/images/2.png') }}" alt="">
                    </div>
                    <div class="address-text">
                        <span class="label">Email Address</span>
                        <span class="des"><a href="mailto:{{$model[2]->value}}">{{$model[2]->value}}</a></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="address-item">
                    <div class="icon-part">
                        <img src="{{ URL::asset('public/frontend/images/3.png') }}" alt="">
                    </div>
                    <div class="address-text">
                        <span class="label">Phone Number</span>
                        <span class="des"><a href="tel:{{$model[1]->value}}">{{$model[1]->value}}</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container map-form-body">
    <div class="row">
        <div class="col-sm-6 col-lg-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834727.5939706746!2d82.19094459096843!3d20.181921536770478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a226aece9af3bfd%3A0x133625caa9cea81f!2sOdisha!5e0!3m2!1sen!2sin!4v1620203882284!5m2!1sen!2sin" width="100%" height="680" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-sm-6">
            <div class="form-body">
                <div class="inner-part">
                    <h2 class="title mb-mb-15">Get In Touch</h2>
                    <p>Have some suggestions or just want to say hi? Our  support team are ready to help you 24/7.</p>
                </div>
                <form class="main-form" id="contact-us-form" action="{{route('contact-us')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="usr" class="label-name">Full Name*</label>
                                <input class="form-control" placeholder="Name*" type="text" name="name">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="usr" class="label-name">Email*</label>
                                <input class="form-control" placeholder="Email*" type="email" name="email">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="usr" class="label-name">Phone*</label>
                                <input class="form-control" placeholder="Phone" type="text" name="phone">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="usr" class="label-name">Subject*</label>
                                <input class="form-control" placeholder="Subject" type="text" name="subject">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="usr" class="label-name">Message</label>
                                <textarea class="form-control" placeholder="Message*" name="message"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="frm-btn text-center mt-1">
                        <input type="submit" value="SUBMIT" class="contact-input">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')

@stop    