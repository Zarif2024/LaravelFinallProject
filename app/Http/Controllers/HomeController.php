<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
 
    
    public function index()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }
}
