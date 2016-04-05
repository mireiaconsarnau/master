			<!-- List Tasks -->
			@if (count($trains) > 0)

				@foreach ($trains as $train)
					<?php $user=\App\User::find($train->associated_user_id);?>
					<div class="panel panel-default">
						<div class="panel-heading">
							{{$user->name}}
						</div>

						<div class="panel-body">

							<table class="table table-striped task-table">

								<tbody>
								<?php $trainsforuser=\App\TrainUpload::trainsforassociateduser($train->associated_user_id)->get();?>

								@if (count($trainsforuser) > 0)
									@foreach ($trainsforuser as $trainforuser)
										<form action="/train/{{ $train->id }}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											{{ method_field('PUT') }}
										<tr>
											<td class="table-text"><div><a href="/train/view/{{$trainforuser->id }}">{{$trainforuser->name_train }}</a> </div></td>
											<td class="table-text"><input type="file" name="file_train" id="file_train" value="{{$trainforuser->file_train }}"><div>
										</div></td>
											<!-- Train Update Button -->
											<td>
													<button type="submit" id="update-train-{{ $trainforuser->id }}" class="btn btn-success">
														<i class="fa fa-pencil-square-o"></i> Update
													</button>
												</form>
											</td>
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
					</div>
				@endforeach
				{!! $trains->render() !!}
			@endif