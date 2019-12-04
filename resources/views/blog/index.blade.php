@extends('welcome')
@section('title', 'Welcome')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <!--================Blog Area =================-->
    <section class="blog_area area-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @if (count($posts) === 0)
                            <div class="alert alert-primary" role="alert">
                                <strong>Whoops!!</strong> No Posts Created yet.
                            </div>
                        @else    
                            @foreach ($posts as $post)
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="{{ 'storage/'.$post->image }}" alt="">
                                        <a href="#" class="blog_item_date">
                                        <h3>{{ $post->created_at->format('d')}}</h3>
                                        <p>{{ $post->created_at->format('M')}}</p>
                                        </a>
                                    </div>
                                    
                                    <div class="blog_details">
                                        <a class="d-inline-block" href="{{ route('post.single', $post->id)}}">
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
                                           
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        @auth
                            <aside class="single_sidebar_widget">
                                <div class="text-center">
                                    <img src="{{ 'storage/'.Auth::user()->image }}" alt="profile picture" height="250" width="250" class="rounded-circle"><br>
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

                        {{-- <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>

                            <form action="#">
                                <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter email" required="">
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100" type="submit">Subscribe</button>
                            </form>
                        </aside> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
