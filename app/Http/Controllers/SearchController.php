<?php

namespace SocialNetwork\Http\Controllers;

use SocialNetwork\Models\User;
use Illuminate\Http\Request;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;

class SearchController extends Controller
{
    
    const QUERY_MIN_LENGTH = 3;

    public function getResults(Request $request, User $user) {
      $query = $request->get('q');
      $query_length = strlen($query);
      $order = $request->get('order');
      $location = $request->get('location');
      $gender = $request->get('gender');
      $count = 0;

      if(!$query) {
        return redirect()->route('home');
      }
      if(!$order) {
        $order = 'relevance';
      }

      $users = null;
      if($query_length > self::QUERY_MIN_LENGTH) {
        $users = $user->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('username', 'LIKE', "%{$query}%")
                      ->get();
        $count = $users->count();
      }

      return view('search.results')->with([
        'query' => $query,
        'order' => $order,
        'location' => $location,
        'gender' => $gender,
        'users' => $users,
        'count' => $count
      ]);
    }

}
