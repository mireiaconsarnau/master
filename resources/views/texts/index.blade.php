@extends('app')

@section('htmlheader_title')
    Text Statistics
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<!-- Display Validation Errors -->


			@include('texts.list')

		</div>
	</div>
@endsection

