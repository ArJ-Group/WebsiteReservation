@extends('layouts.customer')

@section('hero')
<!-- Hero Start -->
<div class="hero">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="hero-text">
                    <h1>Trusted Barbershop</h1>
                    <p>
                        It's 2021 Bro, don't forget to trim your hair to make it trendy!
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-none d-md-block">
                <div class="hero-image">
                    <img src="{{asset('assets/assetsCustomer/img/hero.png')}}" alt="Hero Image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

@endsection

@section('content')
<!-- About Start -->
<div class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6">
                <div class="about-img">
                    <img src="{{asset('assets/assetsCustomer/img/about.jpg')}}" alt="Image">
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="section-header text-left">
                    <p>Learn About Us</p>
                    <h2>25 Years Experience</h2>
                </div>
                <div class="about-text">
                    <p>
                        Barber X is a trusted barbershop that gathers experienced people in their fields to work at our place. More than 1000
                        people have tried our barber quality.
                    </p>
                    <p>
                        There are three main services that we offer, namely Hair Cut, Bread Style, Color & Wash. Come and try it yourself and
                        your hair will be trendy. Don't forget Your Hair Your Style.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Salon Services</p>
            <h2>Best Salon and Barber Services for You</h2>
        </div>
        <div class="row">
            @foreach($serviceCategory as $sc)
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{asset('storage/'.$sc->image)}}" alt="Image">
                    </div>
                    <h3>{{$sc->name}}</h3>
                    <a class="btn" href="{{route('serviceCustomer')}}">Learn More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Pricing Start -->
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Best Pricing</p>
            <h2>We Provide Best Price in the City</h2>
        </div>
        <div class="row">
            @foreach($service as $s)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('storage/'.$s->image)}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>{{$s->name}}</h2>
                        <h3>Rp.{{$s->price}}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Pricing End -->


<!-- Testimonial Start -->
<div class="testimonial">
    <div class="container">
        <div style="margin-bottom: 40px">
            <h2 style="color: #fff">Testimonies from Customers</h2>
        </div>
        <div class="owl-carousel testimonials-carousel">
            @if (count($msg)<=0) <center>
                <h2 style="color: #fff">There are no Messages to show</h2>
                </center>
                @else
                @foreach ($msg as $m)
                <div class="testimonial-item">
                    <h3>{{$m->name}}</h3>
                    <h2>{{$m->title}}</h2>
                    <p>{{$m->messagetext}}</p>
                </div>
                @endforeach
                @endif
        </div>
    </div>
</div>
<!-- Testimonial End -->


<!-- Team Start -->
<div class="team">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Barber Team</p>
            <h2>Meet Our Hair Cut Expert Barber</h2>
        </div>
        <div class="row">
            @foreach($employee as $e)
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('storage/'.$e->image)}}" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>{{$e->name}}</h2>
                        <p>{{$e->skill}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Contact Start -->
<div class="contact">
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" placeholder="Your Name"
                                    required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" placeholder="Your Email"
                                    required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject"
                                    required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" placeholder="Message" required="required"
                                    data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn" type="submit" id="sendMessageButton">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->



@endsection