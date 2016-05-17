@extends('app')

@section('htmlheader_title')
	Texts Statistics
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">


			@include('texts.list')

		</div>
	</div>
@endsection

