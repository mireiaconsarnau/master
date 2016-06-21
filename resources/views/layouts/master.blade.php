@extends('app')

@section('htmlheader_title')
    Tasks
@endsection


@section('main-content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <div class="panel panel-default">

                <div class="panel-heading">




                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{URL::to('messages')}}">All Messages @include('messenger.unread-count')</a></li>
                            <li><a href="{{URL::to('messages/create')}}">New Message</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="container">
                        @yield('content_messenger')
                    </div>
                </div>
             </div>
        </div>
    </div>

@endsection