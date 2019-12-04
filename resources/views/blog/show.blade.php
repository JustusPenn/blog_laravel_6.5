@extends('welcome')
@section('title', $post->title)
@section('content')

    

    <!--================Blog Area =================-->
    <section class="my-0 pb-0 blog_area single-post-area area-padding">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset('storage/'.$post->image) }}" alt="Post Image">
                        </div>
                        <div class="blog_details">
                            <h2>{{$post->title}}</h2>
                            <ul class="blog-info-link mt-3 mb-4">
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
                            <p>{!! $post->description !!}</p>
                        </div>
                        </div>
                        <div class="navigation-top">
                            <div class="d-sm-flex justify-content-between text-center">
                                {{-- <p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span> Lily and 4 people like this</p> --}}
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="comment-count">
                                    @if (count($post->comments) == 1)
                                        <span class="text-danger"><i class="far fa-comment"></i> 01 Comment</span>
                                    @elseif(count($post->comments) > 1)
                                        <span class="text-danger"><i class="far fa-comment"></i> {{count($post->comments)}} Comments</span>
                                    @else
                                        <span class="text-danger"><i class="far fa-comment"></i> No Comments</span>
                                    @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-primary"><strong><i class="far fa-clock"></i> Posted {{ $post->created_at->diffForHumans() }}</strong></span>
                            </div>
                        </div>
                        @auth
                            @if (Auth::user()->id === $post->user_id)
                                <div class="mt-3">
                                    <a href="{{ route('post.edit', $post->id) }}" class="badge badge-primary p-2">Modify</a>
                                    <a href="{{ route('post.destroy', $post->id) }}" class="badge badge-danger p-2" onclick="event.preventDefault(); document.getElementById('delete').submit();" >Delete</a>
                                    <form action="{{ route('post.destroy', $post->id) }}" id="delete" method="post">
                                        @csrf
                                        @method('Delete');
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>


                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="{{ asset('storage/'.$post->user->image) }}" alt="">
                            <div class="media-body">
                                <a href="#">
                                    <h4>{{ $post->user->first.' '.$post->user->last }}</h4>
                                </a>
                                <p>{{ $post->user->about }}</p>
                            </div>
                        </div>
                    </div>
                    @if (count($post->comments)>0)
                        <div class="comments-area">
                            @foreach ($post->comments as $comment)
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                @if ($comment->name == "")
                                                    <img src="{{ asset('storage/'.$comment->user->image) }}" alt="">
                                                @else
                                                    <img src="{{ asset('ui/img/blog/c1.png') }}" alt="">                                                
                                                @endif
                                            </div>
                                            <div class="desc">
                                                <p class="comment">
                                                    {{$comment->comment}} 
                                                </p>

                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h5>
                                                            @if ($comment->user_id =="")
                                                                {{ $comment->name }}</a>
                                                            @else
                                                                <a href="#">{{ $comment->user->first.' '.$comment->user->last }}</a>
                                                            @endif
                                                        </h5>
                                                    </div>

                                                    <div class="reply-btn">
                                                        <p class="date">{{ $comment->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach        
                        </div>
                    @endif
                    <div class="comment-form">
                        <h4>Leave a Comment</h4>
                        <form class="form-contact comment_form" method="POST" action="{{route('comment.store')}}" id="commentForm">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="3" placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                @guest
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                        </div>
                                    </div>
                                @endguest
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm">Submit Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        @auth
                            <aside class="single_sidebar_widget">
                                <div class="text-center">
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="profile picture" height="250" width="250" class="rounded-circle"><br>
                                    {{ Auth::user()->first.' '.Auth::user()->last }} <br>
                                    {{ Auth::user()->occupation }}
                                </div>
                            </aside>
                        @endauth

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            @foreach (App\Post::orderBy('created_at', 'desc')->take(4)->get() as $item)
                                <div class="media post_item">
                                    <img src="{{ asset('storage/'.$item->image) }}" height="90" width="90" alt="post">
                                    <div class="media-body">
                                        <a href="{{ route('post.single', $item->id)}}">
                                            <h3>{{ $item->title }}</h3>
                                        </a>
                                        <p>{{ $item->created_at->format('M d, Y')}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>

                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>

                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Enter email" required>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100" type="submit">Subscribe</button>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area end =================-->
    
@endsection
