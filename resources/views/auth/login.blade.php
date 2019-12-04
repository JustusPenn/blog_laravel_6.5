@extends('welcome')
@section('title', 'Sign In')

@section('content')
    <!--================Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-xl-5 offset-xl-7">
                        <div class="banner_content">
                            <h3>Login</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mt-10">
                                    <input type="email" class="single-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="mt-10">
                                    <input type="password" id="password" class="single-input @error('password') is-invalid @enderror" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = '********'" required autocomplete="current-password">
        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-10 form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-10 text-center">
                                    <button type="submit" class="genric-btn success-border circle">Sign In</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link d-block" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
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
