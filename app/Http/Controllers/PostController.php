<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
            // 'image' => 'file:image|max:5000|mimes:jpg,jpeg,png,gif,bmp',
            // 'document' => 'mimes:doc,docx,pdf,xls,xlsx',
            'caption' => 'required_with:document|max:255',
            'category_id' => 'required',
        ]);

        $post = Post::create($data);
        $post->update(['user_id' => Auth::user()->id]);
        if (request()->file('image')) {
            request()->validate([
                'image' => 'sometimes|file:image|max:5000|mimes:jpg,jpeg,png,gif,bmp'
            ]);
            $post->update([
                'image' => request()->image->store('post', 'public')
            ]);
            Image::make(public_path('storage/'.$post->image))->resize('750', '375')->save();
        }

        if(request()->file('document')) {
            request()->validate([
                'document' => 'sometimes|mimes:doc,docx,pdf,xls,xlsx'
            ]);
            $post->update([
                'document' => request()->document->store('post/document', 'public')
            ]);
        }

        return redirect()->route('index')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = request()->validate([           
            'title' => ['required',Rule::unique('posts')->ignore($post->id), 'max:255'], 
            'description' => 'required',
            'image' => 'file:image|max:5000|mimes:jpg,jpeg,png,gif,bmp',
            'document' => 'mimes:doc,docx,pdf,xls,xlsx',
            'caption' => 'required_with:document|max:255',
            'category_id' => 'required',
        ]);

        $post = $post->update($data);
        
        if (request()->file('image')) {
            request()->validate([
                'image' => 'sometimes|file:image|max:5000|mimes:jpg,jpeg,png,gif,bmp'
            ]);
            
            $path = request()->image->store('post', 'public');
            $post->update(['image' => $path]);
            Image::make(public_path('storage/'.$post->image))->resize('750', '375')->save();
        }

        if(request()->file('document')) {
            request()->validate([
                'document' => 'sometimes|mimes:doc,docx,pdf,xls,xlsx'
            ]);
            
            $path = request()->document->store('post/document', 'public');
            $post->update(['document' => $path]);
        }
        return redirect()->route('index')->with('success', 'Post Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete('storage/'.$post->image);
        foreach ($post->comments as $comment) {
            $comment->delete();
        }
        $post->delete();
        return redirect()->route('index')->with('success', 'Deleted Successfully');
    }
}
