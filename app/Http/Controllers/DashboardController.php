<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


Class Dashboardcontroller extends Controller{ //Dashboard controller
    public function index(){
        //SELECT * FROM posts
        $postsFromDB=Post::all();
        return view('Dashboard.index',['posts'=>$postsFromDB]);
    }
    public function show($id /*route model binding*/){
        $post=Post::where('id',$id)->first()->load('comments');
        return view('Dashboard.show',["s_post"=>$post]);}

    public function create(){
        $Users=User::all();
        return view('Dashboard.create',['Users'=>$Users]);
    }
    public function store(){
        // 1- take data from user
        // two methods the frist one is
        // $data=request()->all();

        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:5'],
            'post_creator'=> ['required','exists:users,id'],
            'post_image'=> ['required','image','mimes:jpeg,png,jpg,gif,svg'],
            'video_url'=> ['url'],
        ]);
        //  second one is to collect single data
        $title=request()->title;
        $description=request()->description;
        $postCreator = request()->post_creator;
        $postImage = request()->post_image;
        $postVideo = request()->video_url;
        $NewImageName=time().'_'.request()->title.'.'.$postImage->Extension();
        $post_content=request()->post_content;
        request()->post_image->move(public_path('images'),$NewImageName);
        //FOR DEBUGING //dd($data);
        Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id'=> $postCreator,
            'post_image'=>$NewImageName,
            'content'=>$post_content,
            'video_url'=>$postVideo,
            //put to use this method we need to define $fillable in model file
        ]);

        // 3- redirection to index page
        return to_route('dashboard.index') ;
    }
    public function edit($postid) {
        $Users=User::all();

        $postfromDB=Post::find($postid);

        return view("Dashboard.edit",['post'=>$postfromDB,'Users'=>$Users]);

    }
    public function update($postid) {
//INPUT VALIDATING
        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:5'],
            'post_creator'=> ['required','exists:users,id'],
            'post_image'=> ['image','mimes:jpeg,png,jpg,gif,svg'],
            'video_url'=> ['url'],
        ]);

        $title=request()->title;
        $description=request()->description;
        $postCreator = request()->post_creator;
        $postImage = request()->post_image;
        $post_content=request()->post_content;
        $video_url=request()->video_url;



        $singlePostfromDB= Post::find($postid);

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
                'user_id' => $postCreator,
                'content' => $post_content,
                'video_url' => $video_url,
            ]);
        } else {
            // Update the database without changing the image
            $singlePostfromDB->update([
                'title' => $title,
                'description' => $description,
                'user_id' => $postCreator,
                'content' => $post_content,
                'video_url' => $video_url,
            ]);
        }
        // 3- redirection to index page
        return to_route("dashboard.show",$postid);
    }
    public function destroy($postid) {
        $postfromDB=Post::find($postid);
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
        return view('dashboard.search',['results'=>$results] );
    }

    }
