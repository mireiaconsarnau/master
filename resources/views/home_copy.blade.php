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
		<?php $locationtests=\App\TestUpload::nTests()->get();?>
		<?php $lasttests=\App\TestUpload::lastTests();?>
		<?php $countries=\App\TestUpload::countries()->get();?>



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
						<span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Train Files</span>
							<span class="info-box-number">{{$ntrains}} uploads</span>
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
							<span class="info-box-number">{{$ntests}} uploads</span>
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
										<div id="world-map-markers" style="height: 400px;"><div id="world-map" style=" height: 400px;"></div>
											<script>
												$(function(){
													$('#world-map').vectorMap({
														map: 'world_mill_en',

														normalizeFunction: 'polynomial',
														hoverOpacity: 0.7,
														hoverColor: false,
														markerStyle: {
															initial: {
																fill: '#00A65A',
																stroke: '#333333'
															}
														},
														regionStyle:{
															initial: {
																fill: '#dddddd',
															}
														},
														backgroundColor: '#ffffff',
														markers: [
														@foreach ($locationtests as $locationtest)
															<?php $location = Location::get($locationtest->ip)?>
															{latLng: [{{$location->latitude}}, {{$location->longitude}}], name: '{{$locationtest->cityName}}'},
														@endforeach
														]
													});
												});
											</script></div>
									</div>

								</div>
								<div class="col-md-3 col-sm-4">
									<div class="pad box-pane-right bg-green" style="min-height: 420px">
										<div class="description-block margin-bottom">
												@foreach ($countries as $country)
													<?php $ncountries=\App\TestUpload::ncountries($country->countryName)->count();?>
													<span>{{$ncountries}} uploaded files from {{$country->countryName}}</span><br>
												@endforeach
										</div>

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
		<!--chat-->
		 <div class="row">
			 <div class="col-md-8"></div>
			 <div class="col-md-4">
				 <!-- DIRECT CHAT -->
				 <div class="box box-warning direct-chat direct-chat-warning">
					 <div class="box-header with-border">
						 <h3 class="box-title">Direct Chat</h3>

						 <div class="box-tools pull-right">
							 <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
							 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							 </button>
							 <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
								 <i class="fa fa-comments"></i></button>
							 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
							 </button>
						 </div>
					 </div>
					 <!-- /.box-header -->
					 <div class="box-body">
						 <!-- Conversations are loaded here -->
						 <div class="direct-chat-messages">
							 <!-- Message. Default to the left -->
							 <div class="direct-chat-msg">
								 <div class="direct-chat-info clearfix">
									 <span class="direct-chat-name pull-left">Alexander Pierce</span>
									 <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
								 </div>
								 <!-- /.direct-chat-info -->
								<!-- /.direct-chat-img -->
								 <div class="direct-chat-text">
									 Is this template really for free? That's unbelievable!
								 </div>
								 <!-- /.direct-chat-text -->
							 </div>
							 <!-- /.direct-chat-msg -->

							 <!-- Message to the right -->
							 <div class="direct-chat-msg right">
								 <div class="direct-chat-info clearfix">
									 <span class="direct-chat-name pull-right">Sarah Bullock</span>
									 <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
								 </div>
								 <!-- /.direct-chat-info -->
								 <!-- /.direct-chat-img -->
								 <div class="direct-chat-text">
									 You better believe it!
								 </div>
								 <!-- /.direct-chat-text -->
							 </div>
							 <!-- /.direct-chat-msg -->

							 <!-- Message. Default to the left -->
							 <div class="direct-chat-msg">
								 <div class="direct-chat-info clearfix">
									 <span class="direct-chat-name pull-left">Alexander Pierce</span>
									 <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
								 </div>
								 <!-- /.direct-chat-info -->
								 <!-- /.direct-chat-img -->
								 <div class="direct-chat-text">
									 Working with AdminLTE on a great new app! Wanna join?
								 </div>
								 <!-- /.direct-chat-text -->
							 </div>
							 <!-- /.direct-chat-msg -->



						 </div>
						 <!--/.direct-chat-messages-->

						 <!-- Contacts are loaded here -->
						 <div class="direct-chat-contacts">
							 <ul class="contacts-list">
								 <li>
									 <a href="#">


										 <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
											 <span class="contacts-list-msg">How have you been? I was...</span>
										 </div>
										 <!-- /.contacts-list-info -->
									 </a>
								 </li>
								 <!-- End Contact Item -->



							 </ul>
							 <!-- /.contatcts-list -->
						 </div>
						 <!-- /.direct-chat-pane -->
					 </div>
					 <!-- /.box-body -->
					 <div class="box-footer">
						 <form action="#" method="post">
							 <div class="input-group">
								 <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat">Send</button>
                          </span>
							 </div>
						 </form>
					 </div>
					 <!-- /.box-footer-->
				 </div>
				 <!--/.direct-chat -->
			 </div>
     	</div>
		<!--endchat-->


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
