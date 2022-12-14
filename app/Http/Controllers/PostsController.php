<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("VerifyCategoriesCount")->only(["create", "store"]);
    }

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
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create", compact(["categories", "tags"]));
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
        $image = $request->file('image')->store('posts');
        // create the post

        $post = Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $image,
            "content" => $request->content,
            "published_at" => $request->published_at,
            "category_id" => $request->category,
        ]);

        if ($request->tags){
            $post->tags()->attach($request->tags);
        }
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
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create", compact(["post", "categories","tags"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();

        if($request->hasFile("image")){
            $image = $request->image->store("posts");

            $post->deleteImage();

            $data["image"] = $image;
        }
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash("success", "Post Updated Successfullly");
        // redirect

       return redirect(route("posts.index"));
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
            $post->deleteImage();
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

    public function restore($id)
    {
        $post = Post::withTrashed()->where("id", $id)->firstOrFail();
        $post->restore();

        session()->flash("success", "Post Restored Successfullly");
        return redirect()->back();
    }
}
