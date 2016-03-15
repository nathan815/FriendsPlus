<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
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
      
      if($request->ajax()) {
        return response()->json([
          'success' => true,
          'comment_html' => view('status.comment')->with([
              'comment' => $comment
            ])->render()
        ]);
      }
      else {
        return redirect()->back()->withAlert([
          'type'=>'success',
          'message'=>'Your comment has been posted.'
        ]);
      }

    }

    public function postDelete(Request $request) {
      $id = $request->input('id');
      $comment = Comment::find($id);
      if(!$comment) {
        abort(404);
      }
      if($comment->delete()) {
        return response()->json([
          'success' => true 
        ]);
      }
      else {
        return response()->json([
          'success' => false,
          'error' => 'Could not delete'
        ]);
      }
    }

    public function getLikes($id) {
      $comment = Comment::find($id);
      if(!$comment) {
        abort(404);
      }
      $users = [];
      foreach($comment->likes as $like) {
        $users[] = $like->user;
      }
      return view('status.likes')->with([
        'comment' => $comment,
        'users' => $users
      ]);
    }

    public function postLike(Request $request) {
      $id = $request->input('id');
      $user = Auth::user();
      $comment = Comment::find($id);
      if(!$comment) {
        abort(404);
      }

      if(!$comment->isOwner() && !$user->isFriendsWith($comment->user)) {
        return response()->json([
          'success' => false,
          'error' => 'Oops! You are not friends with the comment owner.'
        ]);
      }

      if($user->hasLikedComment($comment)) {
        if($comment->likes()->where('user_id', $user->id)->delete()) {
          $likes = $comment->likes()->count();
          return response()->json([
            'success' => true,
            'likes' => $comment->likes()->count(),
            'userHasLiked' => false
          ]);
        }
      }
      else {
        $like = $comment->likes()->create([]);
        $user->likes()->save($like);
        $likes = $comment->likes()->count();
        return response()->json([
          'success' => true,
          'likes' => $comment->likes()->count(),
          'userHasLiked' => true
        ]);
      }

      return response()->json([
        'success' => false,
        'error' => 'Unable to like/unlike comment.'
      ]);

    }
}
