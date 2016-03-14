@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')
		<!-- Main content -->
	<section class="content">

		<div class="row">
			@can('see-admin-menu')


			<div class="col-md-3 col-sm-6 col-xs-12">
				<a href="/tasks" style="color:#333333">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Tasks</span>
							<span class="info-box-number">Create and management tasks</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<a href="/trains"  style="color:#333333">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Train Files</span>
						<span class="info-box-number">Upload train files for use later</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				</a>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<a href="/testsadmin"  style="color:#333333">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Test Files / Analysis</span>
						<span class="info-box-number">Associated test files with train files</span>
					</div>
					<!-- /.info-box-content -->
				</div>
					</a>
				<!-- /.info-box -->
			</div>
			@endcan
			@can('see-user-menu')
			<div class="col-md-3 col-sm-6 col-xs-12">
				<a href="/tests"  style="color:#333333">
					<div class="info-box">
						<span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Test Files</span>
							<span class="info-box-number">Upload test files for a task</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- /.info-box -->
			</div>
			@endcan
		</div>
@endsection
