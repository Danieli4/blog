<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;

class EditeController extends Controller
{
    public function __invoke(Post $post)
    {
        //dd($category);
        return view('admin.post.edit', compact('post'));
    }
}
