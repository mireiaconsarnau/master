@extends('app')

@section('htmlheader_title')
    Test Files
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<!-- Display Validation Errors -->
			@include('common.errors')
			<div class="panel panel-default">

				<div class="panel-heading">
					New Test File
				</div>

				<div class="panel-body">


							<!-- New Train Form -->
					<form action="/test" method="POST" class="form-horizontal" enctype="multipart/form-data">
						{{ csrf_field() }}

								<!-- Train Name -->
						<div class="form-group">
							<label for="file_test" class="col-sm-3 control-label">Test File Name</label>

							<div class="col-sm-6">

								<input type="file" name="file_test" id="file_test" value="{{ old('test') }}">

							</div>

						</div>




		<!-- Add Train Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i> Upload New Test File
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			@include('tests.list')

		</div>
	</div>
@endsection

