<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('index');
    }

    public function set_profile()
    {
        return view('home');
    }

    public function profile()
    {
        $user = Auth::user();
        
        $data = request()->validate([
            'about' => 'required',
            'occupation' => 'required'
        ]);
        
        $user->update($data);
        if(request()->has('image')){
            request()->validate([
                'image' => 'sometimes|file:image|mimes:jpg,jpeg,gif,png|max:5000',
            ]);
            $path = request()->file('image')->store('profile', 'public');
            $user->update(['image' => $path]);
            Image::make(public_path('storage/'.$path))->resize(250,300)->save();
        }
        
        return redirect('/')->with('success', 'Welcome '.Auth::user()->username);
    }

    public function editProfile($username)
    {
        $user = User::where('username', $username)->first();
        // dd($user);
        return view('user.edit', compact('user'));
    }

    public function updateProfile($username)
    {
        $user = User::where('username', $username)->first();

        $data = request()->validate([
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'first' => 'required',
            'last' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'about' => 'required',
            'occupation' => 'required'
        ]);

        $user->update($data);
        if(request()->has('image')){
            request()->validate([
                'image' => 'sometimes|file:image|mimes:jpg,jpeg,gif,png|max:5000',
            ]);
            $path = request()->file('image')->store('profile', 'public');
            $user->update(['image' => $path]);
            Image::make(public_path('storage/'.$path))->resize(300,300)->save();
        }
        
        return redirect()->route('index')->with('success', Auth::user()->username.' Your profile Updated Successfully');
    }

}
