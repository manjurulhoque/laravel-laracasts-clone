@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Filters
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="/forum" style="text-decoration: none">Home</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/forum?filter=me" style="text-decoration: none">Me</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/forum?filter=solved" style="text-decoration: none">Accepted</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/forum?filter=unsolved" style="text-decoration: none">Not Accepted</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('discussions.create') }}" class="form-control btn btn-primary">Create a new
                    discussion</a>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Channels
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach(\App\Channel::all() as $channel)
                                <li class="list-group-item">
                                    <a href="{{ route('channels.show', ['slug' => $channel->slug ]) }}"
                                       style="text-decoration: none;">{{ $channel->title }}</a><span
                                            class="badge">{{ $channel->discussions->count() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @foreach($discussions as $dis)
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <h4>{{ $dis->user->name }} <b>{{ $dis->created_at->diffForHumans() }}</b></h4>
                            <a href="{{ route('discussions.show', ['slug' => $dis->slug]) }}"
                               class="btn btn-default pull-right">View</a>

                            @if($dis->hasBestAnswer())
                                <span class="btn btn-success pull-right">CLOSED</span>
                            @else
                                <span class="btn btn-danger pull-right">NOT CLOSED</span>
                            @endif

                            @if(Auth::id() == $dis->user->id)
                                <a href="{{ route('discussions.edit', $dis->slug) }}"
                                   class="btn btn-default btn-xs pull-right">Edit</a>
                            @endif

                            @if($dis->is_being_watched_by_auth_user())
                                <a href="{{ route('discussion.unwatch', ['id' => $dis->id ]) }}"
                                   class="btn btn-default btn-xs pull-right">unwatch</a>
                            @else
                                <a href="{{ route('discussion.watch', ['id' => $dis->id ]) }}" class="btn btn-default btn-xs pull-right">watch</a>
                            @endif

                        </div>
                        <div class="panel-body">
                            <h3 class="text-center">
                                {{ $dis->content }}
                            </h3>
                            <p class="text-center">
                                {{ str_limit($dis->title, 30) }}
                            </p>
                        </div>
                        <div class="panel-footer">
                            <span>
                                {{ $dis->replies->count() }} replies
                            </span>
                            <a href="{{ route('channel', ['slug' => $dis->channel->slug ]) }}"
                               class="pull-right btn btn-default btn-xs">{{ $dis->channel->title }}</a>
                        </div>
                    </div>
                @endforeach

                <div class="text-center">
                    {{ $discussions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
