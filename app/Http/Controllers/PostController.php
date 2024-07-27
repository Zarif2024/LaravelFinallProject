<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function destroy($id)
    {
        // Find the post by ID and delete it
        $post = Post::findOrFail($id);
        $post->delete();

        // Redirect back with a success message
        return redirect()->route('allusers')->with('success', 'Post deleted successfully.');
    }
    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Method to update the post
    public function updatePost(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Find the post and update it
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        // Redirect back or to another page
        return redirect()->route('allusers')->with('success', 'Post updated successfully.');
    }
    public function createPost(Request $request){
        $postData = $request->validate([
            'title'=> 'required',
            'content'=>'required',

        ]);
        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);
        $postData['user_id'] = auth()->id();
        Post::create($postData);
        return redirect('/');
    }
}
