<!-- List Tasks -->
@if (count($testsadmin) > 0)
	<div class="panel panel-default">
		<div class="panel-heading">
			List All Test Files
		</div>

		<div class="panel-body">

			<table class="table table-striped task-table">

				<thead>
				<th>Associated Task </th>
				<th>Test File Name</th>
				<th>User</th>
				<th>IP</th>
				<th>Country Name</th>
				<th>City Name</th>
				<th>Disabled</th>
				<th>Associated Train File</th>
				<th>Select Train File</th>
				</thead>

				<tbody>
				@foreach ($testsadmin as $testadmin)
					<?php $tasca=\App\Task::find($testadmin->task_id);?>
					<?php $user=\App\User::find($testadmin->user_id);?>
					<?php $train=\App\TrainUpload::find($testadmin->trainupload_id);?>



					<form action="/testadmin/{{ $testadmin->id }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<tr>
							<td class="table-text"><div>
									{{$tasca->name_task}}
								</div>
							</td>
							<td class="table-text"><div><a href="/testadmin/view/{{$testadmin->id }}">{{$testadmin->name_test }}</a> </div></td>
		</div>
		</td>
		<td class="table-text"><div>{{$user->name}} </div></td>
	</div>
	</td>
	<td class="table-text"><div>{{$testadmin->ip }} </div></td>
	</div>
	</td>
	<td class="table-text"><div>{{$testadmin->countryName }} </div></td>
	</div>
	</td>
	<td class="table-text"><div>{{$testadmin->cityName }} </div></td>
	</div>
	</td>
	<td class="table-text"><div>

			<select name="disabled" id="disabled">
				<option value="no"
						@if ($testadmin->disabled=="no")
						selected
						@endif
				>No</option>
				<option value="yes"
						@if ($testadmin->disabled=="yes")
						selected
						@endif
				>Yes</option>
			</select>

		</div></td>
	</div>
	</td>
	<td class="table-text"><div>
			@if ($testadmin->trainupload_id==0)
				-
			@endif
			@if ($testadmin->trainupload_id!=0)
				<a href="/train/view/{{$testadmin->trainupload_id }}">{{$train->name_train }}</a>
			@endif

		</div></td>

	<td><div class="form-group">


			<div class="col-sm-6">
				<select name="trainupload_id" id="trainupload_id">
					<option value="0">Not associated train file</option>
					@foreach ($trainupload_files as $trainupload_file)
						<option value="{{$trainupload_file->id}}"
								@if ($testadmin->trainupload_id==$trainupload_file->id)
								selected
								@endif
						>{{$trainupload_file->name_train}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</td>

	<!-- Task Update Button -->
	<td>


		<button type="submit" id="update-testadmin-{{ $testadmin->id }}" class="btn btn-success">
			<i class="fa fa-pencil-square-o"></i> Update
		</button>

		</form>



	</td>
	<td>
		<form action="/testadmin/analysis/{{ $testadmin->id }}" method="POST">
			{{ csrf_field() }}


			<button type="submit" id="analysis-task-{{ $testadmin->id }}" class="btn btn-warning"
					@if ($testadmin->trainupload_id=="0")
					disabled
					@endif

			>
				<i class="fa fa-bar-chart"></i> Analysis
			</button>
		</form>

	</td>

	</tr>

	@endforeach
	</tbody>
	</table>
	</div>
	</div>
	{!! $testsadmin->render() !!}
@endif