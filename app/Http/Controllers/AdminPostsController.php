<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Photo;
use App\Comment;
use App\Http\Requests\CreatePostsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\CommentReply;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(2);
        $category = Category::lists('name', 'id')->all();
        return view ('admin.posts.index', compact('posts', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $category = Category::lists('name', 'id')->all();
        return view ('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //return Auth::user()->id;
        //return $request->all();

        $input = $request->all();
       // $title = str_slug($request->title, '-');
        
        $user = Auth::user();
        
       if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file'=>$name]);
        $input['photo_id'] = $photo->id;
         }
    
    $user->post()->create($input);
    return redirect ('/admin/posts');
    
     
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
        $post = Post::findorfail($id);
        $category = Category::lists('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostsRequest $request, $id)
    {
        //
        $post = Post::findorfail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName ();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $post->update($input);
        
        return redirect ('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findorfail($id);
        unlink(public_path() . $post->photo->file);
        $post->delete();

        Session::flash('deleted_user', 'The user has been deleted');
        return redirect('/admin/posts');
    }

    public function post($slug){
        $post = Post::findBySlugOrFail($slug);
        $comments = Comment::where('is_active', '1')->get();
        //$replies = CommentReply::where('is_active', '1')->get();
        //$comments = Comment::all();
        return view('post', compact('post', 'comments'));
       
    }
}
