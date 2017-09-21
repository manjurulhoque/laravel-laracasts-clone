<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Pagination\Paginator;

class ForumController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	switch (request('filter'))
	    {
		    case 'me':
		    	$results = Discussion::where('user_id', Auth::id())->paginate(4);
		    	break;
		    case 'solved':
		    	$answered = array();

		    	foreach (Discussion::all() as $d)
			    {
			    	if($d->hasBestAnswer())
				    {
				    	array_push($answered, $d);
				    }
			    }

			    $results = new Paginator($answered, 3);
		    	break;
		    case 'unsolved':
			    $unanswered = array();

			    foreach (Discussion::all() as $d)
			    {
				    if(!$d->hasBestAnswer())
				    {
					    array_push($unanswered, $d);
				    }
			    }

			    $results = new Paginator($unanswered, 3);
		    	break;
		    default:
			    $results = Discussion::paginate(3);
				break;
	    }
        return view('home', ['discussions' => $results]);
    }

	public function channel($slug)
	{
		$channel = Channel::where('slug', $slug)->first();
		return view('channel')->with('discussions', $channel->discussions()->paginate(5));
	}
}
