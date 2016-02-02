			<!-- List Tasks -->
			@if (count($trains) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List train Files
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">
							<thead>
							<th>Train File</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							@foreach ($trains as $train)
								<form action="/train/{{ $train->id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
								<tr>
									<td class="table-text"><div><input type="text" name="file_train" id="file_train" class="form-control" value="{{$train->file_train }}"> </div></td>
									<td class="table-text"><div>



										</div></td>


									<!-- Train Update Button -->
									<td>


											<button type="submit" id="update-train-{{ $train->id }}" class="btn btn-success">
												<i class="fa fa-pencil-square-o"></i> Update
											</button>
										</form>
									</td>
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
				{!! $trains->render() !!}
			@endif


