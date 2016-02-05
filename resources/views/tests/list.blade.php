			<!-- List Tasks -->
			@if (count($tests) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List Test Files
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">
							<thead>
							<th>Associated Task </th>
							<th>Test File Name</th>
							</thead>

							<tbody>
							@foreach ($tests as $test)
								<form action="/test/{{ $test->id }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
								<tr>
									<td class="table-text"><div>

											@foreach (App\Task::name($test->task_id)->get() as $nt)
												{{$nt->name_task}}
											@endforeach

										</div></td>
									<td class="table-text"><div><a href="/test/view/{{$test->id }}">{{$test->name_test }}</a> </div></td>




										</div></td>



									<!-- Test Delete Button -->
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
				{!! $tests->render() !!}
			@endif


