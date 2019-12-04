@extends('welcome')
@section('title', 'Modify '.$user->username.'`s Profile')
@section('content')
    
        <div class="py-4"><br></div>
        <!--================Blog Area =================-->
        <section class="blog_area my-5 ">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Modify {{ $user->username }}'s Profile</h1>
                        <form action="{{ route('profile.update', $user->username) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                      <label for="username">Username</label>
                                      <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ $user->username }}" aria-describedby="usernameId" required>
                                      <small id="usernameId" class="text-muted">This Field is required</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                      <label for="first">First Name</label>
                                      <input type="text" name="first" id="first" class="form-control" placeholder="First Name" value="{{ $user->first }}" aria-describedby="firstId" required>
                                      <small id="firstId" class="text-muted">This Field is Required</small>
                                    </div>                                    
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                      <label for="last">Last Name</label>
                                      <input type="text" name="last" id="last" class="form-control" placeholder="Last Name" value="{{ $user->last }}" aria-describedby="lastId" required>
                                      <small id="lastId" class="text-muted">This Field is required</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $user->email }}" aria-describedby="emailId" required>
                                      <small id="emailId" class="text-muted">This Field is required</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="image">Profile Image</label>
                                        <input type="file" class="form-control-file" name="image" id="image" placeholder="Profile Picture" aria-describedby="fileHelpId">
                                        <small id="fileHelpId" class="form-text text-muted">The Profile picture isn't required</small>
                                    </div>
                                    <div id="image"></div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="about">About</label>
                                        <textarea class="form-control" name="about" id="about" placeholder="Description about you..." rows="5" aria-describedby="aboutId" required>{{ $user->about }}</textarea>
                                        <small id="aboutId" class="form-text text-muted">This Field is required</small>
                                    </div>
                                    <div class="form-group mb-3">
                                      <label for="occupation">Occupation</label>
                                      <input type="text" class="form-control" name="occupation" id="occupation" value="{{ $user->occupation }}" aria-describedby="helpId" placeholder="Ocupation" required>
                                      <small id="helpId" class="form-text text-muted">Occupation is required</small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Area =================-->
@endsection
