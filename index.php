<!DOCTYPE html>
<html lang="en" ng-app="ams">
<head>
	<base href="http://localhost/eunovate/ams/"/>
	<script> var BASE_URL = "/eunovate/ams/service/index.php/";</script>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Eunovate Technologies">
	<meta name="author" content="Eunovate Technologies">

	<link rel="stylesheet" type="text/css" href="./static/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="./static/css/bootstrap-theme.min.css"> -->
	<link rel="stylesheet" type="text/css" href="./static/css/style.css">
	<link rel="stylesheet" type="text/css" href="./static/css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="./static/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./static/css/toastr.min.css">

	<script type="text/javascript" src="./static/js/angular.min.js"></script>
	<script type="text/javascript" src="./static/js/angular-route.min.js"></script>
	<script type="text/javascript" src="./static/js/angular-jwt.js"></script>
	<script type="text/javascript" src="./static/js/angular-storage.js"></script>
	<script type="text/javascript" src="./static/js/ui-bootstrap-tpls-0.13.1.min.js"></script>

	<script type="text/javascript" src="./app/app.js"></script>
	<script type="text/javascript" src="./app/factory.js"></script>

</head>
<body ng-controller="navCtrl">
<div style="height:100%;">
	<div class="row"  ng-if='navibar==true'>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand " href="#"><span class="logofont"><img src="./static/img/eunovate/logo.png" width="30px;" /> Eunovate</span> Attendance Management System</a>
				</div>
				<div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<!-- <li ng-class="{active: getpath()=='home'}">
							<a href="home" title="Home">
								<i class="fa fa-home"></i><span class="hidden-sm"> Home</span>
							</a>
						</li> -->	
						<li ng-class="{active: getpath()=='schedule-list'}">
							<a href="schedule-list" title="Class List">
								<i class="fa fa-calendar-o"></i><span class="hidden-sm"> Schedule</span>
							</a>
						</li>					
						<li ng-class="">
							
						</li>	
						<li ng-class="{active: getpath()=='student-list'}">
							<a href="student-list" title="Student List">
								<i class="fa fa-user"></i><span class="hidden-sm"> Student</span>
							</a>
						</li>
						<li ng-class="{active: getpath()=='vehicle-list'}">
							<a href="vehicle-list" title="Vehicle List">
								<i class="fa fa-car"></i><span class="hidden-sm"> Vehicle</span>
							</a>
						</li>
						<li ng-class="{active: getpath()=='class-list' || getpath()=='course-list' || getpath()=='lesson-list'}" class="dropdown">
							<a href="#" title="Class List" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-th"></i><span class="hidden-sm"> Class</span> <span class="caret"></span>
							</a>

							<ul class="dropdown-menu">
								<li>
									<a href="class-list" title="Class List">
										<i class="fa fa-th"></i><span class="hidden-sm"> Class</span> 
									</a>
								</li>
								<li>
									<a href="course-list" title="Course List">
										<i class="fa fa-book"></i><span class="hidden-sm"> Course</span>
									</a>
								</li>
							</ul>
						</li>
				  	    							
						<li ng-class="{active: getpath()=='user-list' ||
										getpath()=='setting' ||
										getpath()=='system'}" class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i><span class="hidden-sm"> {{username}} </span> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li>
									<a href="system" title="System"><i class="fa fa-cog"></i><span class="hidden-sm"> System</span></a>
								</li>
								<li>
									<a href="user-list"><span class="fa fa-users"></span> User Management</a>

								</li>
								<li><a href="setting"><span class="fa fa-gears"></span> App Settings</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="" ng-click="openchgpassdialog()"><span class="fa fa-lock"></span> Change Password</a></li>
								<li><a href="" ng-click="logout()"><span class="fa fa-sign-out"></span> Logout</a></li>
							</ul>
						</li>
						<li ng-class="{active: getpath()=='notify-list'}">
							<a href="notify-list">
								<span class="fa fa-bell-o"></span>
								<span class="badge badge-notify" ng-if="notidata>0">{{notidata}}</span>
							</a>
						</li>
						<!-- <li><a href="#"><span class="fa fa-wifi"></span></a></li> -->
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div id="wrapper" ng-controller="sidebarCtrl" style="margin-top:50px;" ng-class="{toggled: isCollapsed == true}" ng-if='navibar==true'>
		<!-- Sidebar -->
		<div id="sidebar-wrapper" >
			<ul class="sidebar-nav">
				<li class="sidebar-brand">
					<a href="#">
						<h1>LOGO</h1>
					</a>
				</li>
				<hr/>
				<li ng-repeat="sideMenu in sideMenuList" ng-class="{active: getpath()==sideMenu[1], header: sideMenu[1]=='header'}">
					<a ng-if="sideMenu[1] != 'header'" href="{{sideMenu[1]}}"> {{sideMenu[0]}} <span ng-if="getpath()==sideMenu[1]" class="fa fa-caret-right pull-right" style="position:relative; top:13px; right:20px;"></span> </a>
					<i ng-if="sideMenu[1] == 'header'">{{sideMenu[0]}}</i>
				</li>
			</ul>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<a href="" style="color:black;" ng-click="isCollapsed = !isCollapsed">
				<div class="sidebar-toggle-btn">
					<i class="fa fa-chevron-right fa-2x hidden-xs" ng-if="isCollapsed == true"></i>
					<i class="fa fa-chevron-left fa-2x hidden-xs" ng-if="isCollapsed == false || isCollapsed == NULL"></i>
					<i class="fa fa-chevron-right fa-2x visible-xs" ng-if="isCollapsed == false || isCollapsed == NULL"></i>
					<i class="fa fa-chevron-left fa-2x visible-xs" ng-if="isCollapsed == true"></i>
				</div>
			</a>
			<div class="container-fluid" style="min-height:100px;">
				<div class="row">
					<div class="col-lg-12">
						<div ng-view scroll></div>
					</div>
				</div>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>

	<div id="container-fluid" ng-if='navibar==false'>
		<div class="row">
			<div class="col-lg-12">
				<div ng-view scroll></div>
			</div>
		</div>
	</div>

</div>
<div class="footer">Developed by: <a href="https://www.eunovate.com" target="_blank" style="color:black;" class="logofont">Eunovate Technologies</a></div>

<script type="text/javascript" src="./static/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="./static/js/angular-animate.min.js"></script>
<script type="text/javascript" src="./static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./static/js/toastr.min.js"></script>
<script type="text/javascript" src="./static/js/highcharts.js"></script>
<script type="text/javascript" src="./static/js/exporting.js"></script>
<script type="text/javascript" src="./static/js/moment.js"></script>

<script type="text/javascript" src="./app/controllers/controller.js"></script>

<!-- app controllers -->
<script type="text/javascript" src="./app/controllers/home_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/course_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/lesson_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/student_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/vehicle_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/class_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/user_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/schedule_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/school_staff_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/behaviour_ctrl.js"></script>
<script type="text/javascript" src="./app/controllers/notification_ctrl.js"></script>
<!-- -->

<script type="text/javascript" src="./app/directive.js"></script>
<script type="text/javascript" src="./app/service.js"></script>

<?php require_once("./static/partials/chgpassdialog.php"); ?> 

</body>
</html>