<?php

namespace FriendsPlus\Http\Controllers;

use Request;
use Auth;

use FriendsPlus\Http\Requests\NewCommentRequest;
use FriendsPlus\Http\Controllers\Controller;
use FriendsPlus\Models\Status;
use FriendsPlus\Models\Comment;

class CommentsController extends Controller
{
    
    public function postNew(NewCommentRequest $request, $status_id) {
      $status = Status::where('access_id', $status_id)->first();
      if(!$status) {
        abort(404);
      }
      $comment = new Comment;
      $comment->user_id = Auth::user()->id;
      $comment->status_id = $status->id;
      $comment->body = $request->body;
      $comment->save();
      
      if(Request::ajax()) {
        return response()->json([
          'success'=>true
        ]);
      }
      else {
        return redirect()->back()->withAlert([
          'type'=>'success',
          'message'=>'Your comment has been posted.'
        ]);
      }

    }
}
