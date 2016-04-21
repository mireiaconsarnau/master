@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')
		<!-- Main content -->
	<section class="content">
		<?php $ntasksOn=\App\Task::nTasksOn()->count();?>
		<?php $ntasksOff=\App\Task::nTasksOff()->count();?>
		<?php $nusersAdmin=\App\User::nUsersAdmin()->count();?>
		<?php $nusersStandard=\App\User::nUsersStandard()->count();?>
		<?php $ntrains=\App\TrainUpload::nTrains()->count();?>
		<?php $ntests=\App\TestUpload::nTests()->count();?>

		<div class="row">
			@can('see-admin-menu')
			<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Users</span>
							<span class="info-box-number">{{$nusersAdmin}} admin users</span>
							<span class="info-box-number">{{$nusersStandard}} standard users</span>
						</div>
					</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Tasks</span>
						<span class="info-box-number">{{$ntasksOn}} tasks On</span>
						<span class="info-box-number">{{$ntasksOff}} tasks Off</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Train Files</span>
						<span class="info-box-number">{{$ntrains}}</span>
					</div>

				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Test Files</span>
						<span class="info-box-number">{{$ntests}}</span>
				</div>
			</div>


			<div class="row">
				<div class="col-md-8">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Visitors Report</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body no-padding">
							<div class="row">
								<div class="col-md-9 col-sm-8">
									<div class="pad">
										<!-- Map will be created here -->
										<div id="world-map-markers" style="height: 325px;"></div>
									</div>
								</div>

							</div>
						</div>
					</div>

					<!-- PRODUCT LIST -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Recently Added Products</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<ul class="products-list product-list-in-box">
								<li class="item">
									<div class="product-info">
										<a href="javascript:void(0)" class="product-title">Samsung TV
											<span class="product-description">
											Samsung 32" 1080p 60Hz LED Smart HDTV.
											</span>
									</div>
								</li>
							</ul>
						</div>
					<div>




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
