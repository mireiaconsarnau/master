			<!-- List Tasks -->
			@if (count($trains) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List Test Files
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">
							<thead>
							<th>Test File Name</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							@foreach ($tests as $test)
								<form action="/test/{{ $test->id }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
								<tr>
									<td class="table-text"><div><a href="/test/view/{{$test->id }}">{{$test->name_test }}</a> </div></td>
									<td class="table-text"><input type="file" name="file_test" id="file_test" value="{{$test->file_trest }}"><div>



										</div></td>


									<!-- Train Update Button -->
									<td>


											<button type="submit" id="update-test-{{ $test->id }}" class="btn btn-success">
												<i class="fa fa-pencil-square-o"></i> Update
											</button>
										</form>
									</td>
									<!-- Train Delete Button -->
									<td>
										<form action="/test/{{ $test->id }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}

											<button type="submit" id="delete-test-{{ $test->id }}" class="btn btn-danger">
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
				{!! $test->render() !!}
			@endif


