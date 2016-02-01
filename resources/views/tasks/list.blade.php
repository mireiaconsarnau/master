@extends('app')

@section('htmlheader_title')
    Tasks
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
						<!-- List Tasks -->
			@if (count($tasks) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						Management Tasks
					</div>

					<div class="panel-body">
						<table class="table table-striped task-table">
							<thead>
							<th>Task Name</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							@foreach ($tasks as $task)
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
										<form action="/task/{{ $task->id }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('UPDATE') }}
											<button type="submit" id="update-task-{{ $task->id }}" class="btn btn-danger">
												<i class="fa fa-btn fa-trash"></i> Update
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
			@endif
		</div>
	</div>
@endsection
