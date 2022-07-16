@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Contact</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Contact</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="section-header text-center" style="margin-top: 90px;">
    <p>Get In Touch</p>
    <h2>If You Have Any Query, Please Contact Us</h2>
</div>
<div class="contact" style="margin-bottom: 90px;">
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="contact-form">
                        <div id="success">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!!</strong><span> {{ $message }}</span>
                            </div>
                            @endif
                        </div>
                        <form action = "{{route('message.store')}}" method = "POST">
                            @csrf
                            <div class="control-group">
                                <input type="text" class="form-control" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" name = "name" />
                                <br>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" name = "email"/>
                                <br>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control"  placeholder="Title" required="required" data-validation-required-message="Please enter a subject" name = "title"/>
                                <br>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control"  placeholder="Message" required="required" data-validation-required-message="Please enter your message" name = "messagetext"></textarea>
                                <br>
                            </div>
                            <div>
                                <button class="btn" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection