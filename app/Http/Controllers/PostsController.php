<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $allPosts = Post::where('user_id', Auth::id())->get();

        return view('Posts.index', ['posts' => $allPosts]);
    }
    public function show(Post $post /*route model binding*/){
        $post->load('comments');
        return view('Posts.show',["post"=>$post]);}
    public function create()
    {
        $user=Auth::user();

       return view('Posts.create',['user'=>$user]);
    }
    public function store(){
        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:5'],
            'post_image'=> ['required','image','mimes:jpeg,png,jpg,gif,svg']
        ]);
        $NewImageName=time().'_'.request()->title.'.'.Request()->post_image->Extension();
        request()->post_image->move(public_path('images'),$NewImageName);
        $newPost = new Post();
        $newPost->title=Request()->title;
        $newPost->description=Request()->description;
        $newPost->user_id=Auth::user()->id;
        $newPost->post_image=$NewImageName;
        $newPost->content=Request()->post_content;
        $newPost->save();
        return to_route('posts.index');
    }
    public function edit($id){
        $post=Post::where('id',$id)->first();
        return view('Posts.edit',['post'=>$post]);
    }
    public function update($id){
        $title=request()->title;
        $description=request()->description;
        $postImage = request()->post_image;
        $post_content=request()->post_content;
        //INPUT VALIDATING
        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:5'],
            'post_image'=> ['image','mimes:jpeg,png,jpg,gif,svg']
        ]);

        $singlePostfromDB= Post::find($id);

        if ($postImage) {
            // Retrieve the old image name
            $oldImageName = $singlePostfromDB->post_image;

            // If an old image exists, delete it from storage
            if ($oldImageName) {
                $oldImagePath = public_path('images') . '/' . $oldImageName;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload the new image
            $NewUpdatedImageName = time() . '_' . request()->title . '.' . $postImage->extension();
            request()->post_image->move(public_path('images'), $NewUpdatedImageName);

            // Update the database with the new image name
            $singlePostfromDB->update([
                'title' => $title,
                'description' => $description,
                'post_image' => $NewUpdatedImageName,
                'content' => $post_content
            ]);
        } else {
            // Update the database without changing the image
            $singlePostfromDB->update([
                'title' => $title,
                'description' => $description,
                'content' => $post_content
            ]);
        }
        // 3- redirection to index page
        return to_route("Posts.show",$id);
    }
    public function destroy($id) {
        $postfromDB=Post::find($id);
        $im_path = public_path('images/' . $postfromDB->image);
        if (file_exists($im_path)) {
            unlink($im_path);
        }
        $postfromDB->delete();
        return to_route("dashboard.index");
    }
    public function search(Request $request){
        $search = $request->search;
        $results=Post::where('title',$search)->orwhere('description','like',$search)->get();
        return view('Posts.search',['results'=>$results] );
    }

}
