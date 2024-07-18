<?php
namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use App\Models\comments;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $posts->load('comments');
        return view('Home.index', compact('posts'));
    }

}
?>
