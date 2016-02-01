@extends('app')

@section('htmlheader_title')
    Tasks
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					New Train File
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

							<!-- New Train Form -->
					<form action="/train" method="POST" class="form-horizontal" enctype="multipart/form-data">
						{{ csrf_field() }}

						<!-- TrainName -->
						<div class="form-group">
							<label for="file_train" class="col-sm-3 control-label">Train File</label>

							<div class="col-sm-6">
								<input type="file" name="file_train" id="file_train"   value="{{ old('train') }}">
							</div>

						</div>




		<!-- Add Train Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i> Upload Train File
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!-- List Trains -->
			@if (count($trains) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List Train Files
					</div>

					<div class="panel-body">
						<table class="table table-striped task-table">
							<thead>
							<th>Train File Name</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							@foreach ($trains as $train)
								<tr>
									<td class="table-text"><a href="#"> <div>{{ $train->name_train }} </div></a></td>

									<!-- Train Delete Button -->
									<td>
										<form action="/train/{{ $train->id }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}

											<button type="submit" id="delete-train-{{ $train->id }}" class="btn btn-danger">
												<i class="fa fa-btn fa-trash"></i> Delete
											</button>
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
