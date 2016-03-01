<?php

namespace SocialNetwork\Http\Controllers;

use SocialNetwork\Models\User;
use Illuminate\Http\Request;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;

class SearchController extends Controller
{
    
    public function getResults(Request $request, User $user) {
      $query = $request->get('q');
      $order = $request->get('order');
      $location = $request->get('location');
      $gender = $request->get('gender');

      if(!$query) {
        return redirect()->route('home');
      }
      if(!$order) {
        $order = 'relevance';
      }

      $users = $user->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('username', 'LIKE', "%{$query}%")
                    ->get();

      return view('search.results')->with([
        'query' => $query,
        'order' => $order,
        'location' => $location,
        'gender' => $gender,
        'users' => $users
      ]);
    }

}
