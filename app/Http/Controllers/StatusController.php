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
    
    public function postNew(NewStatusRequest $request) {
      $status = new Status;
      $status->user_id = Auth::user()->id;
      $status->access_id = mt_rand(100,9999) . time() . mt_rand(100,9999);
      $status->body = $request->body;
      if($status->save()) {
        return redirect()->back();
      }
    }

}
