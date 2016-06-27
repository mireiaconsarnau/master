@extends('layouts.master')

@section('content_messenger')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    @if($threads->count() > 0)
        @foreach($threads as $thread)
            <?php $class = $thread->isUnread($currentUserId) ? 'style="background-color:#D84938; width:59%;color: #ffffff;"' : 'style="background-color:#f8f8f8; width:59%"'; ?>
            <a href="messages/{{$thread->id}}" style="color: #000000;">
            <div class="media alert "{!!$class!!} >
                <h4>{{$thread->subject}}</h4>
                <p>{!! $thread->latestMessage->body !!}</p>
                <p><small><strong>Creator:</strong> {!! $thread->creator()->name !!}</small></p>
                <p><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id()) !!}</small></p>
            </div>
            </a>
        @endforeach
        {!! $threads->render() !!}
    @else
        <p>Sorry, no threads.</p>
    @endif
@stop