<?php

namespace App\Http\Controllers;

use App\Reply;
use App\User;
use Illuminate\Http\Request;
use App\Discussion;
use Auth;
use Session;
use Notification;

class DiscussionController extends Controller
{
	public function create()
	{
		return view('discuss');
	}

	public function edit($slug)
	{
		return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);
	}

	public function update(Request $request, $id)
	{
//		dd($slug);
		$this->validate($request, [
			'contents' => 'required',
		]);

		$discussion = Discussion::find($id);

		$discussion->content = $request->contents;

		$discussion->update();

		Session::flash('success', 'Discussion updated');

		return redirect()->route('forum');
	}

	public function store(Request $request)
	{

//		dd(str_slug($request->title, '-'));

		$this->validate($request, [
			'channel_id' => 'required',
			'contents' => 'required',
			'title' => 'required'
		]);

		$discussion = new Discussion();

		$discussion->title = $request->title;
		$discussion->content = $request->contents;
		$discussion->channel_id = $request->channel_id;
		$discussion->user_id = Auth::id();
		$discussion->slug = str_slug($request->title, '-');

		$discussion->save();

//		$discussion = Discussion::create([
//			'title' => $request->title,
//			'content' => $request->contents,
//			'channel_id' => $request->channel_id,
//			'user_id' => Auth::id(),
//			'slug' => str_slug($request->title, '-')
//		]);
//
		Session::flash('success', 'Discussion succesfully created.');
		return redirect()->route('forum');
	}
	public function show($slug)
	{
		$discussion = Discussion::where('slug', $slug)->first();
		$best_answer = $discussion->replies()->where('best_answer', 1)->first();
		return view('discussions.show')
			->with('d', $discussion)
			->with('best_answer', $best_answer);
	}
	public function reply($id)
	{
		$d = Discussion::find($id);

//		dd(gettype($id));

//		$reply = Reply::create([
//			'user_id' => Auth::id(),
//			'discussion_id' => (int)$id,
//			'content' => request()->reply
//		]);

		$reply = new Reply();

		$reply->user_id = Auth::id();
		$reply->discussion_id = $id;
		$reply->content = request()->reply;

		$reply->save();

//		$reply = Reply::find(request()->reply);

		$reply->user->points += 25;
		$reply->user->save();

		$watchers = array();

		foreach($d->watchers as $watcher):
			array_push($watchers, User::find($watcher->user_id));
		endforeach;

		Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));

		Session::flash('success', 'Replied to discussion.');
		return redirect()->back();
	}
}
