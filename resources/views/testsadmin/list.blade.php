<!-- List Tasks -->

	<?php $tasques=\App\Task::tasques();?>

	@foreach ($tasques as $tasque)



	<div class="panel panel-default">

		<div class="panel-heading">

			{{$tasque->name_task}}

		</div>


		<div class="panel-body">

			<table class="table table-striped task-table">

				<thead>

				<th>Test File Name</th>
				<th>User</th>
				<th>IP</th>
				<th>Country Name</th>
				<th>City Name</th>
				<th>Disabled</th>
				<th>Associated Train File</th>
				<th>Select Other Train File</th>
				</thead>

				<tbody>
				<?php $testsfortask=\App\TestUploadAdmin::testsfortask($tasque->id)->get();?>

				@if (count($testsfortask) > 0)
				@foreach ($testsfortask as $testfortask)
					<?php $tasca=\App\Task::find($testfortask->task_id);?>
					<?php $user=\App\User::find($testfortask->user_id);?>
					<?php $train=\App\TrainUpload::find($testfortask->train_upload_id);?>



					<form action="/testadmin/{{ $testfortask->id }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<tr>

							<td class="table-text"><div><a href="/testadmin/view/{{$testfortask->id }}">{{$testfortask->name_test }}</a> </div></td>
		</div>
		</td>
		<td class="table-text"><div>{{$user->name}} </div></td>
	</div>
	</td>
	<td class="table-text"><div>{{$testfortask->ip }} </div></td>
	</div>
	</td>
	<td class="table-text"><div>{{$testfortask->countryName }} </div></td>
	</div>
	</td>
	<td class="table-text"><div>{{$testfortask->cityName }} </div></td>
	</div>
	</td>
	<td class="table-text"><div>

			<select name="disabled" id="disabled">
				<option value="no"
						@if ($testfortask->disabled=="no")
						selected
						@endif
				>No</option>
				<option value="yes"
						@if ($testfortask->disabled=="yes")
						selected
						@endif
				>Yes</option>
			</select>

		</div></td>
	</div>
	</td>
	<td class="table-text"><div>
			@if ($testfortask->train_upload_id==0)
				-
			@endif
			@if ($testfortask->train_upload_id!=0)
				<a href="/train/view/{{$testfortask->train_upload_id }}">{{$train->name_train }}</a>
			@endif

		</div></td>

	<td><div class="form-group">


			<div class="col-sm-6">
				<select name="train_upload_id" id="train_upload_id">

					@foreach ($trainupload_files as $trainupload_file)
						<option value="{{$trainupload_file->id}}"
								@if ($testfortask->train_upload_id==$trainupload_file->id)
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


		<button type="submit" id="update-testadmin-{{ $testfortask->id }}" class="btn btn-success">
			<i class="fa fa-pencil-square-o"></i> Update
		</button>

		</form>



	</td>


	</tr>
		@endforeach


	<tr>


		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text" style="background-color: #FFFFFF;"></td>
		<td class="table-text"  style="background-color: #FFFFFF;">
				<form action="/testadmin/analysis/{{ $testfortask->id }}" method="POST">
					{{ csrf_field() }}


					<button type="submit" id="analysis-task-{{ $testfortask->id }}" class="btn btn-warning"
							@if ($testfortask->train_upload_id=="0")
							disabled
							@endif

					>
						<i class="fa fa-bar-chart"></i> Analysis
					</button>
				</form>

		</td>

	</tr>
@endif
	</tbody>
	</table>
	</div>
	</div>
	@endforeach


	{!! $tasques->render() !!}
