@extends('app')

@section('htmlheader_title')
    Analysis
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-22 col-sm-82">
			<!-- Display Validation Errors -->
			@include('common.errors')

			<img src="../../../img.png">


		</div>
	</div>
@endsection

