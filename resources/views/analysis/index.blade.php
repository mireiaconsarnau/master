
@extends('appA')

@section('htmlheader_title')
	Analysis
@endsection


@section('main-content')

	<div class="container">
		<div class="col-sm-offset-22 col-sm-82">
			<div class="panel panel-default">
				<div class="panel-body">
					@foreach ($inf as $line)
						{{$line}}<br>
					@endforeach
				</div>
			</div>


		</div>
	</div>

@endsection



