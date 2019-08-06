<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Http\Requests;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::user()->id;
//        $post_id = Post::where('user_id', $user_id)->value('id')->get();
        //  $value = array_get($post_id, 'user_id');

         $comments = Comment::all();
       //  $commentum = Comment::all();
        // return view ('admin.comment.index', compact('comments'));

        // $comments = Comment::table('posts')
        //             ->where('user_id', '$user_id')
        //             ->get();
   //   $comments = Comment::where('post_id', '$post_id')->get();
      return view ('admin.comment.index', compact('comments'));
        //$post = Post::all();
     // return $comments;
      // return Auth::user()->id;
        
  // return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       $user = Auth::user();
       // $post_id = Post::where('user_id', $user_id)->get();
        $data = [
            'post_id' => $request->post_id,
            'user_id' => $user->id,
           // 'author' => $user->post('user_id')->name,
           //'email' => $user->email,
            'body' => $request->body,
            'is_active' => 0,
        ];
        //Comment::create($data);
        $user->comment()->create($data);
        Session::flash('comment', 'Your comment has been submitted and waiting for moderation!');
        return redirect()->back();

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
        $input= $request->all();
        $comments=Comment::findorFail($id);
        $comments->update($input);
        return redirect()->back();
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
        $comments = Comment::findorfail($id);
        $comments->delete();
        return redirect()->back();
    }
}
