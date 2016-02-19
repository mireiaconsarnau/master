			<!-- List Tasks -->
			@if (count($testsadmin) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List Test Files
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">
							<thead>
							<th>Associated Task </th>
							<th>Test File Name</th>
							</thead>

							<tbody>
							@foreach ($testsadmin as $testadmin)
								<?php $tasca=\App\Task::find($testadmin->task_id);?>
								<?php if($tasca->available=='On'){?>
								<form action="/testadmin/{{ $testadmin->id }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
								<tr>
									<td class="table-text"><div>


												{{$tasca->name_task}}


										</div></td>
									<td class="table-text"><div><a href="/testadmin/view/{{$testadmin->id }}">{{$testadmin->name_test }}</a> </div></td>




										</div></td>



									<!-- Test Delete Button -->
									<td>
										<form action="/testadmin/{{ $testadmin->id }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}

											<button type="submit" id="delete-test-{{ $testadmin->id }}" class="btn btn-danger">
												<i class="fa fa-btn fa-trash"></i> Delete
											</button>
										</form>
									</td>
								</tr>
							<?php }?>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				{!! $testsadmin->render() !!}
			@endif


