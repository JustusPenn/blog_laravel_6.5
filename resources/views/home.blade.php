@extends('welcome')
@section('title', 'Create Profile')
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
                        <h1 class="text-center">Create Profile</h1>
                        <form action="{{ route('set-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
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
                                        <textarea class="form-control" name="about" id="about" placeholder="Description about you..." rows="5" aria-describedby="aboutId"></textarea>
                                        <small id="aboutId" class="form-text text-muted">This About is required</small>
                                    </div>
                                    <div class="form-group mb-3">
                                      <label for="occupation">Occupation</label>
                                      <input type="text" class="form-control" name="occupation" id="occupation" aria-describedby="helpId" placeholder="Ocupation">
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
