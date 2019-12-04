@extends('welcome')
@section('title', 'Register')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-xl-5 offset-xl-7">
                        <div class="banner_content">
                            <h3><i class="fa fa-registered" aria-hidden="true">egister</i></h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mt-10">
                                    <input type="text" class="single-input @error('username') is-invalid @enderror" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
                                    
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-10">
                                    <input type="text" class="single-input @error('first') is-invalid @enderror" name="first" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required>
                                    
                                    @error('first')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-10">
                                    <input type="text" class="single-input @error('last') is-invalid @enderror" name="last" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required>
                                    
                                    @error('last')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-10">
                                    <input type="email" class="single-input @error('email') is-invalid @enderror" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
                                
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-10">
                                    <input type="password" class="single-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = '********'" required>
                                
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-10">
                                    <input type="password" class="single-input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="confirm_password" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = '********'" required>
                                </div>
                                <div class="mt-10 text-center">
                                    <button type="submit" class="genric-btn success-border circle">SignUp</button>
                                </div>
                                <div class="mt-10 text-center">
                                    <a class="btn btn-link d-block" href="{{ route('login') }}">Don't have an account?</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
  
@endsection
