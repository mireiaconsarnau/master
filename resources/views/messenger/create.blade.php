@extends('layouts.master')

@section('content_messenger')

    {!! Form::open(['route' => 'messages.store']) !!}
    <div class="col-md-6">
        <!-- Subject Form Input -->
        <div class="form-group">
            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        @if($users->count() > 0)
            <div class="checkbox">

            <select name="recipients[]" id="recipients[]" multiple>

                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>

                @endforeach
            </select>
            @endif
            </div>
                    <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
    </div>
    {!! Form::close() !!}
@stop