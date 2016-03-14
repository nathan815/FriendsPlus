<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use FriendsPlus\Http\Requests\NewStatusRequest;
use FriendsPlus\Http\Controllers\Controller;
use FriendsPlus\Models\User;
use FriendsPlus\Models\Status;

class StatusController extends Controller
{

    public function getView($id) {
      $status = Status::where('access_id', $id)->first();
      return view('status.view')->with([
        'status' => $status
      ]);
    }

    public function getLikes($id) {
      $status = Status::where('access_id', $id)->first();
      $users = [];
      foreach($status->likes as $like) {
        $users[] = $like->user;
      }
      return view('status.likes')->with([
        'status' => $status,
        'users' => $users
      ]);
    }
    
    public function postNew(NewStatusRequest $request) {
      $status = new Status;
      $status->user_id = Auth::user()->id;
      if($request->input('to') && $request->input('to') != Auth::user()->id) {
        $status->to_user_id = $request->input('to');
      }
      $status->access_id = mt_rand(100,9999) . time() . mt_rand(100,9999);
      $status->body = $request->body;
      if($status->save()) {
        return redirect()->back();
      }
    }

    public function postLike(Request $request) {
      $id = $request->input('id');
      $user = Auth::user();
      $status = Status::find($id);
      if(!$status) {
        abort(404);
      }

      if(!$status->isOwner() && !$user->isFriendsWith($status->user)) {
        return response()->json([
          'success' => false,
          'error' => 'Oops! You are not friends with the status owner.'
        ]);
      }

      if($user->hasLikedStatus($status)) {
        if($status->likes()->where('user_id', $user->id)->delete()) {
          $likesThis = Status::find($id)->getLikeInfo();
          return response()->json([
            'success' => true,
            'likesThis' => $likesThis,
            'likes' => $status->likes()->count(),
            'userHasLiked' => false
          ]);
        }
      }
      else {
        $like = $status->likes()->create([]);
        $user->likes()->save($like);
        $likesThis = Status::find($id)->getLikeInfo();
        return response()->json([
          'success' => true,
          'likesThis' => $likesThis,
          'likes' => $status->likes()->count(),
          'userHasLiked' => true
        ]);
      }

      return response()->json([
        'success' => false,
        'error' => 'Unable to like/unlike status.'
      ]);

    }

}
