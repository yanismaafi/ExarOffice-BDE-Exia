<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Helpers\ToastNotifier;
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
        $posts = Post::orderByDesc('created_at')->paginate(6);

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
    public function store (Request $request)
    {
        if(request()->ajax())
        {
            $request->validate([
                'title' =>   'required|string|min:4|max:100',
                'theme' =>   'required|string|min:2|max:30',
                'content' => 'required|string|min:10',
                'image'  =>  'required|image|mimes:jpeg,jpg,png,gif|max:10000' //max : 10000Kb = 10 mb
            ]);

            $post = new Post();
            $post->author = auth::user()->name;
            $post->title = ucfirst($request->title);
            $post->theme = ucfirst($request->theme);
            $post->content = ucfirst($request->content);
            $this->storeImage($request, $post);
            $post->save();
            
            $notification = new ToastNotifier('success','Post ajouté', 'Le post a été ajouté avec succès',null,null);
            return $notification->toJson();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrfail($id);
        return view('blog.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment (Request $request)
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

        return response()->json('sent',200);

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $image_path = storage_path('app/public/'.$post->image);
      
        if(Storage::disk('public')->exists($post->image))
        {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        $notification = new ToastNotifier('success','Post supprimé','Le post a été supprimé avec succès','removeTableRow',$post->id);
        return $notification->toJson();  
    }


    private function storeImage(Request $request, Post $post) 
    {
        if($request->image) 
        {
          $post->image = $request->image->store('Blog','public');
        }
    }



}
