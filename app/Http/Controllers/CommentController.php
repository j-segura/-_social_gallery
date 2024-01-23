<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'picture_id' => 'required',
            'comment' => 'required',
        ]);

        $comment = new Comment;

        $comment->content = $request->comment;
        $comment->picture_id = $request->picture_id;
        $comment->autor_id = Auth::user()->id;

        $comment->save();

        return redirect()->route('home');

    }
}
