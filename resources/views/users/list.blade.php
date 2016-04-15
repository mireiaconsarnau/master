			<!-- List Users -->
			@if (count($users) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						List Users
					</div>

					<div class="panel-body">

						<table class="table table-striped task-table">
							<thead>
							<th>User Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>Retype password</th>
							<th>Type</th>

							</thead>
							<tbody>
							@foreach ($users as $user)

								<form action="/user/{{ $user->id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
								<tr>
									<td class="table-text"><div><input type="text" name="name" id="name" class="form-control" value="{{$user->name }}"> </div></td>
									<td class="table-text"><div><input type="text" name="email" id="email" class="form-control" value="{{$user->email }}"> </div></td>
									<td class="table-text"><div><input type="password" name="password" id="password" class="form-control" value="{{$user->password }}"> </div></td>
									<td class="table-text"><div><input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{$user->password }}"> </div></td>
									<td class="table-text"><div>

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

										</div></td>
									<td class="table-text"><div>



										</div></td>


									<!-- User Update Button -->
									<td>


											<button type="submit" id="update-user-{{ $user->id }}" class="btn btn-success">
												<i class="fa fa-pencil-square-o"></i> Update
											</button>
										</form>
									</td>
									<!-- User Delete Button -->
									<td>
										<form action="/user/{{ $user->id }}" method="POST" onsubmit=" return confirmDeleteUser()">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}

											<button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger">
												<i class="fa fa-btn fa-trash"></i> Delete
											</button>
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				{!! $users->render() !!}
			@endif


