			<!-- List Users -->
			@if (count($users) > 0)
				@foreach ($users as $user)
				<div class="panel panel-default">

					<div class="panel-heading">
						{{$user->name }}
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">

							<tbody>


								<form action="/user/{{ $user->id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<tr>

											<div class="col-sm-6">
												<select name="type" id="type">
													<option value="1"
															@if ($user->type=="1")
															selected
															@endif
													>Admin User</option>
													<option value="2"
															@if ($user->type=="2")
															selected
															@endif
													>Standard User</option>
												</select>
											</div>

									</tr>
									<br><br>
								<tr>

									<div class="col-sm-6">
										<input type="text" name="name" id="name" class="form-control" value="{{$user->name }}">
									</div>

									<div class="col-sm-6">
										<input type="text" name="email" id="email" class="form-control" value="{{$user->email }}">
									</div>

								</tr>
									<br><br>
								<tr>

									<div class="col-sm-6">
										<input type="password" name="password" id="password" class="form-control" value="{{$user->password }}">
									</div>

									<div class="col-sm-6">
										<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{$user->password }}">
									</div>

								</tr>
									<br><br>
								<tr><div style="float: right;">
										<div style="float: left;">
										<!-- User Update Button -->

										<button type="submit" id="update-user-{{ $user->id }}" class="btn btn-success">
											<i class="fa fa-pencil-square-o"></i> Update
										</button> &nbsp;
									</form>
									</div>
									<div style="float: left;">
									<!-- User Delete Button -->

										<form action="/user/{{ $user->id }}" method="POST" onsubmit=" return confirmDeleteUser()">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}

											<button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger">
												<i class="fa fa-btn fa-trash"></i> Delete
											</button>
										</form>
									</div>
								</div>

								</tr>

							</tbody>
						</table>

					</div>
				</div>
				@endforeach

				{!! $users->render() !!}
			@endif


