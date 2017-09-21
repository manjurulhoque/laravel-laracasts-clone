@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center">Update your reply</div>

        <div class="panel-body">
            <form action="{{ route('reply.update', $reply->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="content">Edit Reply</label>
                    <textarea name="contents" id="content" cols="10" rows="10" class="form-control">{{ $reply->content }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success pull-right" type="submit">Update Reply</button>
                </div>

            </form>
        </div>
    </div>

@endsection