<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\Post;

class MainPageController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::query();

        if ($request->has('orderBy')) {
            $posts->orderBy('id', $request->orderBy);
        }

        return view('main_pages.welcome', ['posts' => $posts->paginate(9)]);
    }
}
