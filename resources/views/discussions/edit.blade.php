@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center">Update your discussion</div>

        <div class="panel-body">
            <form action="{{ route('discussions.update', $discussion->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="content">Ask a question</label>
                    <textarea name="contents" id="content" cols="20" rows="10" class="form-control">{{ $discussion->content }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success pull-right" type="submit">Update discussion</button>
                </div>

            </form>
        </div>
    </div>

@endsection