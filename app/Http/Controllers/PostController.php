<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CommentRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);

        return view('blog.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (BlogRequest $request)
    {
        if( $request->file('image') )
        {
           $image = $request->file('image');
           $imageFullName = $image->getClientOriginalName();
           $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
           $extension = $image->getClientOriginalExtension();
           $file = time() . '_' . $imageName . '.' . $extension;
           $image->move('images/blog',$file);
        }

        Post::create([
           'author' => auth::user()->name,
           'title'  => $request->title,
           'theme'  => $request->theme,
           'content'=> $request->content,
           'image'  => $file,
        ]);

        return response()->json('posted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($blog)
    {
        $post = Post::find($blog);

        return view('blog.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment (CommentRequest $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $post = Post::find($request->post_id);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = $request->input('content');
        $comment->post()->associate($post);

        $comment->save();

        return response()->json('sent');

    }


}
