<div class="panel panel-default">
		<div class="panel-heading">
			Text Statistics
		</div>


		<div class="panel-body">
			<table class="table table-striped task-table">
				<thead>
				<th>User</th>
				<th>Train Files</th>
				<th>Tasks</th>

				</thead>

				<tbody>
				<?php $nusersStandard=\App\User::nUsersStandard();?>

				@if (count($nusersStandard) > 0)
					@foreach ($nusersStandard as $nuserStandard)
						<?php $ntrainsforuser=\App\TrainUpload::trainsforassociateduser($nuserStandard->id)->count();
							$inf="";
							if ($ntrainsforuser==0){
								$inf="Any associated train files";
								}
							else{
								$trainsforuser=\App\TrainUpload::trainsforassociateduser($nuserStandard->id)->get();

								foreach ($trainsforuser as $trainforuser){
									$inf.=$trainforuser->name_train.", ";
								}
								$inf=substr($inf,0, -2);
							}
						?>
						<?php $ntestsforuser=\App\TestUploadAdmin::testsforuser($nuserStandard->id)->count();
						$inf2="";
						if ($ntestsforuser==0){
							$inf2="Any associated test files";
						}
						else{
							$testsforuser=\App\TestUploadAdmin::testsforuser($nuserStandard->id)->get();

							foreach ($testsforuser as $testforuser){
								$tasca=\App\Task::find($testforuser->task_id);
								$inf2.=$tasca->name_task.", ";
							}
							$inf2=substr($inf2,0, -2);
						}
						?>
							<tr>
								<td class="table-text"><div>{{$nuserStandard->name}}</div></td>
								<td class="table-text"><div>{{$inf}}</div></td>
								<td class="table-text"><div>{{$inf2}}</div></td>
								<td class="table-text"><div>
										<form action="/textstatistics/{{$nuserStandard->id}}" method="POST"  target="_blank">
										{{ csrf_field() }}
											<button type="submit" id="analysis-task-" class="btn btn-info">
												<i class="fa fa-pie-chart"> Text Statistics</i>
											</button>

										</form>
								</div></td>

							</tr>

					@endforeach


<tr>
	<td class="table-text"><div></div></td>
	<td class="table-text"><div></div></td>
	<td class="table-text"><div></div></td>
	<td class="table-text"  style="background-color: #FFFFFF;"><form action="/textstatistics/all/" method="POST" target="_blank">
			{{ csrf_field() }}
			<button type="submit" id="analysis-task-" class="btn btn-warning">
				<i class="fa fa-pie-chart"> All Users (pdf)</i>
			</button>
		</form>
	</td>
</tr>
@endif
</tbody>
</table>
</div>
</div>

