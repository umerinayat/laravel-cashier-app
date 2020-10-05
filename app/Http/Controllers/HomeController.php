<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

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
        $data = [];

        $data['posts'] = Post::with('author')->get();

        return view('home', $data);
    }

    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->with('author')->first();

        return view('posts.show', [
            'post' => $post
        ]);
    }
    
}
