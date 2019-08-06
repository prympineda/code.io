<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\CommentReply;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Http\Requests;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $user_id = Auth::user()->id;
        // $replies = CommentReply::all();
        // return view ('admin.comments.replies.index', compact('replies'));
    
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
    }

    public function createreply(Request $request)
    {
        $user = Auth::user();
       // $post_id = Post::where('user_id', $user_id)->get();
        $data = [
            'comment_id' => $request->comment_id,
            'user_id' => $user->id,
           // 'author' => $user->post('user_id')->name,
           //'email' => $user->email,
            'body' => $request->body,
            'is_active' => 1,
        ];
        //Comment::create($data);
        $user->commentreply()->create($data);
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
        $comment = Comment::findorFail($id);
        $replies = $comment->commentreply;
        return view ('admin.comment.commentreplies.index', compact('replies'));
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
        $comments=CommentReply::findorFail($id);
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
        $comments = CommentReply::findorfail($id);
        $comments->delete();
        return redirect()->back();
    }
}
