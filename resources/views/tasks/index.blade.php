




@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">


				<div class="panel-body">


							<!-- New Task Form -->
					<form action="{{ url('task') }}" method="POST" class="form-horizontal">
						{!! csrf_field() !!}

								<!-- Task Name -->
						<div class="form-group">
							<label for="task-name" class="col-sm-3 control-label">Task</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="task-name" class="form-control">
							</div>
						</div>

						<!-- Add Task Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-plus"></i> Add Task
								</button>
							</div>
						</div>
					</form>
				</div>






			</div>
		</div>
	</div>
</div>
@endsection
