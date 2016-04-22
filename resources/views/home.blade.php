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
		<?php $lasttests=\App\TestUpload::lastTests();?>


	@can('see-admin-menu')




			<!-- Info boxes -->
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Users</span>
							<span class="info-box-number">{{$nusersAdmin}} admin users</span>
							<span class="info-box-number">{{$nusersStandard}} standard users</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Tasks</span>
							<span class="info-box-number">{{$ntasksOn}} tasks On</span>
							<span class="info-box-number">{{$ntasksOff}} tasks Off</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-green"><i class="a fa-file-text"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Train Files</span>
							<span class="info-box-number">{{$ntrains}}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Test Files</span>
							<span class="info-box-number">{{$ntests}}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->



			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<div class="col-md-8">
					<!-- MAP & BOX PANE -->
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Users Report</h3>

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
										<div id="world-map-markers" style="height: 400px;"><div id="world-map" style=" height: 400px"></div>
											<script>
												$(function(){
													$('#world-map').vectorMap({
														map: 'world_mill_en',
														scaleColors: ['#C8EEFF', '#0071A4'],
														normalizeFunction: 'polynomial',
														hoverOpacity: 0.7,
														hoverColor: false,
														markerStyle: {
															initial: {
																fill: '#383f47',
																stroke: '#ff0000'
															}
														},

														backgroundColor: '#cccccc',
														markers: [
															{latLng: [41.90, 12.45], name: 'Vatican City'},
															{latLng: [43.73, 7.41], name: 'Monaco'},
															{latLng: [-0.52, 166.93], name: 'Nauru'},
															{latLng: [-8.51, 179.21], name: 'Tuvalu'},
															{latLng: [43.93, 12.46], name: 'San Marino'},
															{latLng: [47.14, 9.52], name: 'Liechtenstein'},
															{latLng: [7.11, 171.06], name: 'Marshall Islands'},
															{latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis'},
															{latLng: [3.2, 73.22], name: 'Maldives'},
															{latLng: [35.88, 14.5], name: 'Malta'},
															{latLng: [12.05, -61.75], name: 'Grenada'},
															{latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines'},
															{latLng: [13.16, -59.55], name: 'Barbados'},
															{latLng: [17.11, -61.85], name: 'Antigua and Barbuda'},
															{latLng: [-4.61, 55.45], name: 'Seychelles'},
															{latLng: [7.35, 134.46], name: 'Palau'},
															{latLng: [42.5, 1.51], name: 'Andorra'},
															{latLng: [14.01, -60.98], name: 'Saint Lucia'},
															{latLng: [6.91, 158.18], name: 'Federated States of Micronesia'},
															{latLng: [1.3, 103.8], name: 'Singapore'},
															{latLng: [1.46, 173.03], name: 'Kiribati'},
															{latLng: [-21.13, -175.2], name: 'Tonga'},
															{latLng: [15.3, -61.38], name: 'Dominica'},
															{latLng: [-20.2, 57.5], name: 'Mauritius'},
															{latLng: [26.02, 50.55], name: 'Bahrain'},
															{latLng: [0.33, 6.73], name: 'São Tomé and Príncipe'}
														]
													});
												});
											</script></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="col-md-4">
					<!-- PRODUCT LIST -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Latest Test Files Uploads</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<ul class="products-list product-list-in-box">
								@foreach ($lasttests as $lasttest)
									<?php $tasca=\App\Task::find($lasttest->task_id);?>
									<?php $user=\App\User::find($lasttest->user_id);?>
									<li class="item">
										<div class="product-info">
											<a href="javascript:void(0)" class="product-title">{{$user->name}} ({{$user->email}})</a>
											<span class="product-description">
											 <?php $location = Location::get($lasttest->ip)?>
												{{$location->ip}}
												{{$location->latitude}}
												{{$location->longitude}}
												from {{$lasttest->cityName}} ({{$lasttest->countryName}})
											</span>
												<span class="product-description">
											  {{$lasttest->name_test}} for <b>{{$tasca->name_task}}</b>
											</span>
										</div>
									</li>
									@endforeach
											<!-- /.item -->

									<!-- /.item -->
							</ul>
						</div>
						<!-- /.box-body -->

						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->



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
	</section>

@endsection
