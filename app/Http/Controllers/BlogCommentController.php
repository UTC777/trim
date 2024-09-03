<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'comment' => 'required|string',
        ]);

        $post = Post::findOrFail($postId);

        Comment::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'comment' => $request->input('comment'),
            'post_id' => $post->id,
            'published' => true, // Change this if you have a moderation system
        ]);

        return redirect()->route('blog.show', $post->slug)->with('success', 'Your comment has been posted.');
    }
}

