@extends('app')

@section('htmlheader_title')
    Page not found
@endsection

@section('contentheader_title')
    404 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 403</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Error.</h3>
        <p>
           You don't have power here!
            Meanwhile, you may <a href='{{ url('/home') }}'>return to dashboard</a> or try using the search form.
        </p>

    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection