<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // upload image
        // $image  = $request->image->store("posts");
        $image = $request->file('image')->store('avatars');
        // create the post

        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => "storage/".$image,
            "content" => $request->content,
            // "published_at" =>
        ]);
        // flash message
        session()->flash("success", "Post created Successfullly");
        // redirect

       return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $post = Post::withTrashed()->where("id", $id)->firstOrFail();
        if($post->trashed())
        {
            Storage::delete($post->image);
            $post->forceDelete();
        }
        else{
            $post->delete();
        }

         // flash message
         session()->flash("success", "Post Deleted Successfullly");
         // redirect

        return redirect(route("posts.index"));
    }

     /**
     * Display a list of trashed posts
     *
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view("posts.index", compact("posts"));
    }
}
