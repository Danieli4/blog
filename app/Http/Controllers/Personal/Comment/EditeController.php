<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class EditeController extends Controller
{
    public function __invoke(Comment $comment)
    {

        return view('personal.comment.edite', compact('comment'));
    }
}
