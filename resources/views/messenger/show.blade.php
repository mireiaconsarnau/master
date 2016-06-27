@extends('layouts.master')

@section('content_messenger')
    <div class="col-md-6">
        <h1>{!! $thread->subject !!}</h1>

        @foreach($thread->messages as $message)
            <div class="media">
                <a class="pull-left" href="#">

                </a>
                <div class="media-body">
                    <h5 class="media-heading">{!! $message->user->name !!}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                </div>
            </div>
        @endforeach

        <h2>Add a new message</h2>
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        @if($users->count() > 0)
            <div class="checkbox">

                <select name="recipients[]" id="recipients[]" multiple>

                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>

                    @endforeach
                </select>
               
            </div>
            @endif

                    <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
    </div>
@stop