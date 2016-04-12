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
				<th>Train Files</th>

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
		</div>
	</td>
	<td class="table-text"><div>
			<?php $numbertrain=\App\TrainUpload::Numbertrainsforassociateduser($testfortask->user_id);?>
				{{$numbertrain}}
		</div></td>





	<td>
		<form action="/testadmin/{{ $testfortask->id }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}

			<button type="submit" id="delete-test-{{ $testfortask->id }}" class="btn btn-danger">
				<i class="fa fa-btn fa-trash"></i> Delete
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


		<td class="table-text"  style="background-color: #FFFFFF;">
				<form action="/testadmin/analysis/{{ $testfortask->id }}" method="POST" target="_blank">
					{{ csrf_field() }}
					<button type="submit" id="analysis-task-{{ $testfortask->id }}" class="btn btn-warning"
							@if ($testfortask->train_upload_id=="0")
							disabled
							@endif

							>
						<i class="fa fa-bar-chart"> Analysis</i>
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
