@extends('app')

@section('htmlheader_title')
    Test Files
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-22 col-sm-82">
			<!-- Display Validation Errors -->
			@include('common.errors')



			@include('testsadmin.list')

		</div>
	</div>
@endsection

