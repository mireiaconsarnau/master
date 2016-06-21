@extends('layouts.master')

@section('content_messenger')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    @if($threads->count() > 0)
        @foreach($threads as $thread)
            <?php $class = $thread->isUnread($currentUserId) ? 'style="background-color:#e3a1a1; width:59%"' : ''; ?>
            <div class="media alert "{!!$class!!} >
                <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                <p>{!! $thread->latestMessage->body !!}</p>
                <p><small><strong>Creator:</strong> {!! $thread->creator()->name !!}</small></p>
                <p><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id()) !!}</small></p>
            </div>
        @endforeach
        {!! $threads->render() !!}
    @else
        <p>Sorry, no threads.</p>
    @endif
@stop