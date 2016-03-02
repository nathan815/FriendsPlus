<?php

namespace SocialNetwork\Http\Controllers;

use DB;
use SocialNetwork\Models\User;
use Illuminate\Http\Request;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;

class SearchController extends Controller
{
    
    const QUERY_MIN_LENGTH = 2;

    public function getResults(Request $request, User $user) {
      $query = $request->get('q');
      $query_length = strlen($query);
      $order = $request->get('order');
      $location = $request->get('location');
      $gender = $request->get('gender');

      if(!$query) {
        return redirect()->route('home')->withAlert([
          'type' => 'danger',
          'message' => 'You did not enter a search query.'
        ]);
      }

      if(!$order) {
        $order = 'relevance';
      }

      $users = null;
      $count = 0;
      if($query_length > self::QUERY_MIN_LENGTH) {
        
        $q = User::query();
        $q->searchNameOrUsername($query);

        if($location) {
          $q->searchLocation($location);
        }
        if($gender) {
          $q->searchGender($gender);
        }
        if($order == 'relevance') {
          //$q->orderBy();
        }
        else if($order == 'alpha') {
          $q->orderBy('name', 'ASC')
            ->orderBy('username', 'ASC');
        }
        $users = $q->get();
        $count = $users->count();

      }


      return view('search.results')->with([
        'query' => $query,
        'order' => $order,
        'location' => $location,
        'gender' => $gender,
        'users' => $users,
        'count' => $count,
        'user' => $user
      ]);
    }

}
