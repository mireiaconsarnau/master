@extends('app')

@section('htmlheader_title')
    Users
@endsection


@section('main-content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<!-- Display Validation Errors -->
			@include('common.errors')
			<div class="panel panel-default">

				<div class="panel-heading">
					New User
				</div>

				<div class="panel-body">


							<!-- New User Form -->
					<form action="/user" method="POST" class="form-horizontal">
						{{ csrf_field() }}

								<!-- User Name -->
						<div class="form-group">
							<label for="name" class="col-sm-3 control-label">User Name</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="name" class="form-control" value="{{ old('user') }}">
							</div>

						</div>
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email</label>

							<div class="col-sm-6">
								<input type="text" name="email" id="email" class="form-control" value="{{ old('user') }}">
							</div>

						</div>
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Password</label>

							<div class="col-sm-6">
								<input type="password" name="password" id="password" class="form-control" value="{{ old('user') }}">
							</div>

						</div>
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Retype Password</label>

							<div class="col-sm-6">
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('user') }}">
							</div>

						</div>

						<div class="form-group">
							<label for="type" class="col-sm-3 control-label">Type</label>

							<div class="col-sm-6">
								<select name="type" id="type">
									<option value="1">Admin User</option>
									<option value="2" selected>Standard User</option>
								</select>
							</div>
						</div>




		<!-- Add User Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i> Add User
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			@include('users.list')

		</div>
	</div>
@endsection

