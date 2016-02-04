			<!-- List Tasks -->
			@if (count($tasks) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List Tasks
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">
							<thead>
							<th>Task Name</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>


								<form action="/task/{{ $task->id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
								<tr>
									<td class="table-text"><div><input type="text" name="name_task" id="name_task" class="form-control" value="{{$task->name_task }}"> </div></td>
									<td class="table-text"><div>

											<select name="available_task" id="available_task">
												<option value="On"
														@if ($task->available=="On")
														selected
														@endif
												>On</option>
												<option value="Off"
														@if ($task->available=="Off")
														selected
														@endif
												>Off</option>
											</select>

										</div></td>


									<!-- Task Update Button -->
									<td>


											<button type="submit" id="update-task-{{ $task->id }}" class="btn btn-success">
												<i class="fa fa-pencil-square-o"></i> Update
											</button>
										</form>
									</td>
									<!-- Task Delete Button -->
									<td>
										<form action="/task/{{ $task->id }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}

											<button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
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
				{!! $tasks->render() !!}
			@endif


