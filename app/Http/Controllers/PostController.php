<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        $posts = Post::where('user_id', Auth::id())->paginate(9);
        return view('posts.allPosts', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.createPost');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:10|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $imageName = $request->image->getClientOriginalName();
        $request->file('image')->move('posts', $imageName);
        $data['image'] = $imageName;

        Post::create($data);

        return redirect()->route('my-posts');
    }


    public function show(Post $post)
    {
        return view('posts.showPost', [
            'post' => $post,
        ]);
    }

    public function edit(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required|max:10|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->has('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->file('image')->move('posts', $imageName);
            $data['image'] = $imageName;
        }
        $post->update($data);

        return redirect()->route('my-posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('my-posts');
    }

}
