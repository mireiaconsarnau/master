<?php $nusersStandard=\App\User::nUsersStandard();?>
@foreach ($nusersStandard as $nuserStandard)
<div class="panel panel-default">
	<div class="panel-heading">
		{{$nuserStandard->name}}
	</div>

	<div class="panel-body">

		<table class="table table-striped task-table">

			<tbody>
			<?php $trainsforuser=\App\TrainUpload::trainsforassociateduser($nuserStandard->id)->get();?>

			@if (count($trainsforuser) > 0)
				@foreach ($trainsforuser as $trainforuser)
					<tr>
						<td>
					<form action="/train/{{ $trainforuser->id }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('PUT') }}

							<td class="table-text"><div><a href="/train/view/{{$trainforuser->id }}">{{$trainforuser->name_train }}</a> </div></td>
							<td class="table-text"><input type="file" name="file_train" id="file_train" value="{{$trainforuser->file_train }}"><div>
								</div></td>
							<!-- Train Update Button -->
							<td>
								<button type="submit" id="update-train-{{ $trainforuser->id }}" class="btn btn-success">
									<i class="fa fa-pencil-square-o"></i> Update
								</button>
							</td>
					</form>

					<!-- Train Delete Button -->
					<td>
						<form action="/train/{{ $trainforuser->id }}" method="POST"  onsubmit=" return confirmDeleteTrain()">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}

							<button type="submit" id="delete-train-{{ $trainforuser->id }}" class="btn btn-danger">
								<i class="fa fa-btn fa-trash"></i> Delete
							</button>
						</form>
					</td>
					</tr>
				@endforeach
			@endif

			</tbody>
		</table>
	</div>










	<div class="panel-body">

		<table class="table table-striped task-table">

			<tbody>

			<?php $trainsforuser=\App\TrainUpload::trainsforassociateduser($nuserStandard->id)->get();?>

			@if (count($trainsforuser) > 0)
				<tr>
					<td class="table-text"><div>
				@foreach ($trainsforuser as $trainforuser)

							<a href="/train/view/{{$trainforuser->id }}">{{$trainforuser->name_train }}</a>
				@endforeach
						</div></td>
				</tr>
			@endif
			@if (count($trainsforuser) == 0)
				<tr>
					<td class="table-text">
						Any associated train files
					</td>
				</tr>
			@endif

			<tr>
					<td class="table-text"  style="background-color: #FFFFFF;">
					<form action="/testadmin/analysis/{{ $trainforuser->id }}" method="POST" target="_blank">
						{{ csrf_field() }}
						<button type="submit" id="analysis-task-{{ $trainforuser->id }}" class="btn btn-warning"


						>
							<i class="fa fa-pie-chart"> Text Statitics</i>
						</button>

					</form>



				</td>

			</tr>

			</tbody>
		</table>
	</div>
</div>
@endforeach
{!! $nusersStandard->render() !!}