@extends('welcome')
@section('title', $user->username)
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="py-5"></div>
    <!--================Blog Area =================-->
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget">
                            <div class="text-center">
                                <img src="{{ asset('storage/'.$user->image) }}" alt="profile picture" height="250" width="250" class="rounded-circle"><br>
                                {{ $user->first.' '.$user->last }} <br>
                                {{ $user->occupation }} <br>
                                @auth
                                    @if ($user->id == Auth::user()->id)
                                        <a href="{{ route('profile.edit', Auth::user()->username) }}" class="badge badge-primary">Edit Profile</a>
                                    @endif
                                @endauth
                            </div>
                        </aside>

                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">About Me</h4>

                            <p>{{ $user->about }}</p>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @if(count($user->posts) == 0)
                            <div class="my-3 alert alert-primary">
                                <strong>Whoops!!!</strong> No Posts Created
                            </div>
                        @else
                            @foreach ($user->posts as $post)
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="{{ asset('storage/'.$post->image) }}" alt="">
                                        <a href="#" class="blog_item_date">
                                        <h3>{{ $post->created_at->format('d')}}</h3>
                                        <p>{{ $post->created_at->format('M')}}</p>
                                        </a>
                                    </div>
                                    
                                    <div class="blog_details">
                                        <a class="d-inline-block" href="single-blog.html">
                                            <h2>{{ $post->title }}</h2>
                                        </a>
                                        <p>{!! Str::words($post->description, 30, ' ...') !!}</p>
                                        <ul class="blog-info-link">
                                            <li><a href="{{ route('get-profile', $post->user->username) }}"><i class="far fa-user"></i> {{ $post->user->username }}</a></li>
                                            <li><a href="#"><i class="fas fa-briefcase"></i> {{ $post->category->category}}</a></li>
                                            @if (count($post->comments) == 1)
                                                <li><a href=""><i class="far fa-comments"></i> 01 Comment</a></li>
                                            @elseif(count($post->comments) > 1)
                                                <li><a href=""><i class="far fa-comments"></i> {{count($post->comments)}} Comments</a></li>
                                            @else
                                                <li><a href=""><i class="far fa-comments"></i> No Comments</a></li>
                                            @endif
                                            <li class="text-right"><a href=""><i class="far fa-clock"></i> Posted {{ $post->created_at->diffForHumans() }}</a></li>
                                        </ul>

                                    </div>
                                </article>
                            @endforeach                 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <!--================Blog Area =================-->
@endsection
