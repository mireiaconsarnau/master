@extends('app')

@section('htmlheader_title')
    Tasks
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<!-- Display Validation Errors -->
			@include('common.errors')
			<div class="panel panel-default">

				<div class="panel-heading">
					New Task
				</div>

				<div class="panel-body">


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
									<i class="fa fa-btn fa-plus"></i> Add Task
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			@include('tasks.list')

		</div>
	</div>
@endsection

