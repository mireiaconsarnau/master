@extends('app')

@section('htmlheader_title')
    Tasks
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					New Task
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

							<!-- New Task Form -->
					<form action="/task" method="POST" class="form-horizontal">
						{{ csrf_field() }}

								<!-- Task Name -->
						<div class="form-group">
							<label for="name_task" class="col-sm-3 control-label">Task Name</label>

							<div class="col-sm-6">
								<input type="text" name="name_task" id="name_task" class="form-control" value="{{ old('task') }}">
							</div>

						</div>


						<!-- Available Task-->
						<div class="form-group">
							<label for="available_task" class="col-sm-3 control-label">Available</label>

							<div class="col-sm-6">
								<select name="available_task" id="available_task">
									<option value="On">On</option>
									<option value="Off" selected>Off</option>
								</select>
							</div>
						</div>

		<!-- Add Task Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i>Add Task
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

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
							@foreach ($tasks as $task)
								<tr>
									<td class="table-text"><div>{{ $task->name_task }} ({{ $task->available }})</div></td>

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
