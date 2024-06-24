<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboardcontroller;

class PostsController extends Controller
{
    public function index()
    {
        $allposts = Post::all();
        return view('posts.index', ['posts' => $allposts]);
    }
    public function show(Post $post /*route model binding*/){
        return view('Posts.show',["post"=>$post]);}
}
