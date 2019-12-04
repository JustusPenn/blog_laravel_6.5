
@extends('welcome')
@section('title', 'Modify Post')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <!--================Blog Area =================-->
    <section class="my-1 pb-0 blog_area single-post-area area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">                 
                    <!-- create post form -->
                    <section class="comment-form">
                        <h4>Create Post</h4>
                        <form class="form-contact comment_form" action="{{ route('post.update', $post->id) }}" method="POST" id="commentForm" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH");
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control" name="title" id="title" value="{{ $post->title }}" type="text" placeholder="Title">
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <div class="form-group d-flex flex-column">
                                        <label for="image">Image</label>
                                        <input name="image" id="image" type="file">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="category_id">Category</label>
                                      <select class="form-control" name="category_id" id="category_id">
                                        <option>Choose a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control w-100" name="description" id="description" cols="30" rows="5" placeholder="Write Post Description">{{ $post->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group d-flex flex-column">
                                        <label for="document">Document</label>
                                        <input name="document" id="document" type="file">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label for="caption">Caption</label>
                                        <input name="caption" class="form-control" id="caption" type="text" value="{{ $post->caption }}" aria-labelledby="captionId">
                                        <small class="muted" id="captionId">Required if Document is uploaded</small>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn button-contactForm">Submit</button>
                            </div>
                        </form>
                    </section>
                    <!-- create post form -->
                </div>
            
                <div class="col-md-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget">
                            <div class="text-center">
                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="profile picture" height="250" width="250" class="rounded-circle"><br>
                                {{ Auth::user()->first.' '.Auth::user()->last }} <br>
                                {{ Auth::user()->occupation }}
                            </div>
                        </aside>
    
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
