		/**************************** Schedule List Controller ****************************/
app.controller("schedule_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Schedule_ctrl";
	$scope.animationsEnabled = true;
	
	var date = new Date();
 	$scope.todaydate = date;

	getschedulelist(date,1);
	function getschedulelist(srhdate,srhpara){
		var record = {};
		record.srhdate = $filter('date')(srhdate, "yyyy-MM-dd");
		record.srhpara = srhpara;
		// console.log(record);
		loadData(serviceurl,'getschedulelst',record).success(function(data){
			// console.log(data);
	    	$scope.schedulelst=data;
		});
	}
	$scope.getschedulelist=getschedulelist;

	$scope.findclass=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getschedulelist();
		    return;
		   }

		   $scope.filteredClass=$scope.class; 
		}
    }

 	$scope.addscheduoledialog = function (size){ 	
		$scope.sedit=false;
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'scheduledialog',
	      controller: 'ScheduleModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	$scope.editscheduoledialog = function (size,sdata){ 	
		$scope.sedit=true;
		$scope.schedule = sdata;
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'scheduledialog',
	      controller: 'ScheduleModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	$scope.addtadialog = function (size,sdata){
 		$scope.schedule = sdata; 	
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'assigndialog',
	      controller: 'taAssignModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	$scope.viewdetaildialog = function (size,sdata){
 		$scope.scheduledata = sdata; 	
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'scheduledetaildialog',
	      controller: 'scheduleDetailModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	$scope.datetypesel = [{'name':'Today','value':'1'}, {'name':'This week','value':'2'}, {'name':'This month','value':'3'}, {'name':'Next month','value':'4'}];
 	$scope.datevale = $scope.datetypesel[0];

 	
 	//increment date
 	$scope.plusdate = function(){
 		var adddate = $scope.todaydate.setDate($scope.todaydate.getDate()+1);
 		$scope.todaydate = new Date(adddate);
 		$scope.datesearchblk = true;
		$scope.weeksearchblk=false;
		$scope.monthsearchblk = false;
 		getschedulelist($scope.todaydate,1);
 	}

 	//decrement date
 	$scope.minusdate = function(){
 		var subdate = $scope.todaydate.setDate($scope.todaydate.getDate()-1);
 		$scope.todaydate = new Date(subdate);
 		$scope.datesearchblk = true;
		$scope.weeksearchblk=false;
		$scope.monthsearchblk = false;
 		getschedulelist($scope.todaydate,1);
 	}

 	//search with date
 	$scope.datesearchblk = true;
 	$scope.weeksearchblk=false;
 	$scope.monthsearchblk = false;
 	
 	$scope.dateselsrh = function(){
 		// console.log($scope.datevale);
 		var formatdate = new Date;
 		var startday = '';
 		var endday = '';
 		var wmno = '';
 		if($scope.datevale.value==2){
 			wmno = moment(formatdate).format('ww');
 			startday = moment(formatdate).startOf('isoWeek').format('DD/MM/YYYY');
 			endday = moment(formatdate).endOf('isoWeek').format('DD/MM/YYYY');
 			$scope.datesearchblk = false;
		 	$scope.weeksearchblk=true;
		 	$scope.monthsearchblk = false;
 			getschedulelist(formatdate,2);
 			
 		}else if($scope.datevale.value==3){
 			// startday = moment(formatdate).startOf('month').format('DD/MM/YYYY');
 			// endday = moment(formatdate).endOf('month').format('DD/MM/YYYY');
 			wmno = moment(formatdate).format('MM');
 			endday = moment(formatdate).format('MMMM');
 			
 			$scope.datesearchblk = false;
 			$scope.weeksearchblk=false;
 			$scope.monthsearchblk = true;
 			getschedulelist(formatdate,3);
 		}else if($scope.datevale.value==4){
 			nextmonthdate = formatdate.setMonth(formatdate.getMonth()+1);
 			// startday = moment(nextmonthdate).startOf('month').format('DD/MM/YYYY');
 			// endday = moment(nextmonthdate).endOf('month').format('DD/MM/YYYY');
 			wmno = moment(nextmonthdate).format('MM');
 			endday = moment(nextmonthdate).format('MMMM');
 			$scope.datesearchblk = false;
 			$scope.weeksearchblk=false;
 			$scope.monthsearchblk = true;
 			getschedulelist(nextmonthdate,3);
 		}else{
 			$scope.todaydate = formatdate;
 			$scope.datesearchblk = true;
			$scope.weeksearchblk=false;
			$scope.monthsearchblk = false;
 			getschedulelist($scope.todaydate,1);
 		}
 		$scope.startday = startday;
		$scope.endday = endday;
		$scope.wmno = wmno;
 		// console.log(startday,endday);
 	}

});

		/**************************** Schedule Modal Controller ****************************/
app.controller("ScheduleModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Schedule_ctrl";

	var date = new Date();

	//get class list
	function getscheduledatalst(chkclassid,chkvehicleid,chkdriverid){
		loadData(serviceurl,'getscheduledata','').success(function(data){
			// console.log(data);
			// console.log(chkclassid,chkvehicleid,chkdriverid);
			$scope.classlst=data.classlst;
			$scope.vehiclelst=data.vehiclelst;
			$scope.driverlst=data.driverlst;

			$scope.courselst = data.courselst;
			$scope.lessonlst = data.lessonlst;

			if(chkclassid!=0){
				// console.log($scope.classlst);
				for(var kc=0;kc<$scope.classlst.length;kc++){
					if(chkclassid==$scope.classlst[kc].class_id){
						$scope.classsel = $scope.classlst[kc];
					}
				}
				courselst(scope.schedule.class_id);
				lessonlst(scope.schedule.course_id);
			}else{
	    		// $scope.classsel = $scope.classlst[0];
			}
    		
    		if(scope.sedit==true){
    			for(var kco=0;kco<$scope.formatcourselst.length;kco++){
    				if(scope.schedule.course_id==$scope.formatcourselst[kco].course_id){
	    				$scope.coursesel = $scope.formatcourselst[kco];
	    			}
    			}


    			for(var kl=0;kl<$scope.formatlessonlst.length;kl++){
    				if(scope.schedule.lesson_id==$scope.formatlessonlst[kl].lesson_id){
	    				$scope.lessonsel = $scope.formatlessonlst[kl];
	    			}
    			}
    			// console.log(scope.schedule.course_id,$scope.coursesel,$scope.lessonsel);
    		}else{
    			// $scope.coursesel = $scope.formatcourselst[0];
    			// $scope.lessonsel = $scope.formatlessonlst[0];
    		}
    		// console.log($scope.formatcourselst);

			
			if(chkvehicleid!=0){
				for(var kv=0;kv<$scope.vehiclelst.length;kv++){
					if(chkvehicleid==$scope.vehiclelst[kv].vehicle_id){
						$scope.vehiclesel = $scope.vehiclelst[kv];
					}
				}
			}else{
	    		$scope.vehiclesel = $scope.vehiclelst[0];
			}

			if(chkdriverid!=0){
				// console.log($scope.driverlst);
				for(var kd=0;kd<$scope.driverlst.length;kd++){
					if(chkdriverid==$scope.driverlst[kd].user_id){
						$scope.driversel = $scope.driverlst[kd];
					}
				}
			}else{
	    		$scope.driversel = $scope.driverlst[0];
			}
		});
	}

	//select change class
	$scope.classselchange = function(){
		// console.log($scope.classsel);
		courselst($scope.classsel.class_id);
	}

	//select change course
	$scope.courseselchange = function(){
		// console.log($scope.coursesel);
		lessonlst($scope.coursesel.course_id);
	}

	//sel course list
	function courselst(classselid){
		//select course list based on class
		var courselst = [];
		var classid = classselid;
		for(var i=0; i<$scope.courselst.length;i++){
			// console.log(classid,data.courselst[i].class_id);
			if(classid==$scope.courselst[i].class_id){
				courselst.push($scope.courselst[i]);
			}
		}
		$scope.formatcourselst = courselst;
	}

	//sel lesson list
	function lessonlst(courseselid){
		//select lesson list based on course
   		var lessonlst = [];
		var courseid = courseselid;
		for(var j=0; j<$scope.lessonlst.length;j++){
			// console.log(courseid,data.lessonlst[j].course_id);
			if(courseid==$scope.lessonlst[j].course_id){
				lessonlst.push($scope.lessonlst[j]);
			}
		}
		$scope.formatlessonlst = lessonlst;
	}

	if(scope.sedit==true){
		$scope.title="Schedule Editing";
		
		var classid = scope.schedule.class_id;
		var vehicileid = scope.schedule.vehicle_id;
		var driverid = scope.schedule.driver_id;
		getscheduledatalst(classid,vehicileid,driverid);
		var formatsdate = new Date(scope.schedule.schedule_date);
		$scope.scheduledate = formatsdate;

		var sstarttime = new Date(scope.schedule.start_time);
		var estarttime = new Date(scope.schedule.end_time);
		$scope.stime = new Date(sstarttime.getFullYear(),sstarttime.getMonth(),sstarttime.getDay(), sstarttime.getHours(),sstarttime.getMinutes(),0);
		$scope.etime = new Date(estarttime.getFullYear(),estarttime.getMonth(),estarttime.getDay(), estarttime.getHours(),estarttime.getMinutes(),0);

		$scope.caddress = scope.schedule.contact_address;
		$scope.cphone = scope.schedule.contact_phone;
	}
	else{
		getscheduledatalst(0,0,0);
		$scope.scheduledate = date;
		$scope.stime = new Date(date.getFullYear(),date.getMonth(),date.getDay(), date.getHours(),date.getMinutes(),0);
		$scope.etime = new Date(date.getFullYear(),date.getMonth(),date.getDay(), date.getHours()+1,date.getMinutes(),0);

		$scope.title="Schedule Registration";
	}

	$scope.saveschedule=function(){
		var record = {};
		record.cuserid = $rootScope.userid;
		record.classid = $scope.classsel.class_id;
		record.courseid = $scope.coursesel.course_id;
		record.lessonid = $scope.lessonsel.lesson_id;
		record.scheduledate = $filter('date')($scope.scheduledate, "yyyy-MM-dd");
		record.starttime = $filter('date')($scope.stime, record.scheduledate+" HH:mm:ss");
		record.endtime = $filter('date')($scope.etime, record.scheduledate+" HH:mm:ss");
		record.vechicleid = $scope.vehiclesel.vehicle_id;
		record.driverid = $scope.driversel.user_id;
		
		if($scope.caddress==undefined){
			record.caddress = '';
		}else{
			record.caddress = $scope.caddress;
		}
		if($scope.cphone==undefined){
			record.cphone = '';
		}else{
			record.cphone = $scope.cphone;
		}
		// console.log(record);		

		if(scope.sedit==false){
			// console.log(record);
			loadData(serviceurl,"addscheduledata",record).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("Schedule Registered Successfully!");
					$modalInstance.close();
					scope.getschedulelist(scope.todaydate,scope.datevale.value);
				}
			});		
		}
		else{
			record.scheduleid = scope.schedule.schedule_id;
			// console.log(record);
			loadData(serviceurl,"updatescheduledata",record).success(function(data){	
				if(data.success==true){
					toastr.success("Schedule Data Updated Successfully!");
					$modalInstance.close();
					scope.getschedulelist(scope.todaydate,scope.datevale.value);
				}
			});			
		}
	}

	$scope.closecoursedialog=function(){
   		$modalInstance.close();
    }	
});
			/**************************** Teacher Assign Modal Controller ****************************/
app.controller("taAssignModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Schedule_ctrl";

	$scope.title="Teacher Assign";
	// console.log(scope.schedule);
	if(scope.schedule.head_teacher_id){
		getteacherlst(scope.schedule.head_teacher_id);
	}else{
		getteacherlst(0);
	}

	//get teacher list
	function getteacherlst(checkval){
		loadData(serviceurl,'getteacherlst','').success(function(data){
			// console.log(data);
			$scope.teacherlst = data;
			if(checkval!=0){
				for(var ht=0;ht<$scope.teacherlst.length;ht++){
					if(checkval == $scope.teacherlst[ht].user_id){
						$scope.mteachersel = $scope.teacherlst[ht];
					}
				}
			}
			
		});
	}

	//get ta lists
	gettalst();
	$scope.tablk =false;
	function gettalst(){
		var record = {};
		record.scheduleid = scope.schedule.schedule_id;
		loadData(serviceurl,'gettalst',record).success(function(data){
			// console.log(data);
			$scope.talsts = data.talst;
			if(data.talst.length>0){
				$scope.tablk =true;
			}else{
				$scope.tablk =false;
			}
		});
	}

	//del ta from this schedule
	$scope.delta = function(deluserid){
		var record = {};
		record.userid = deluserid;
		record.scheduleid = scope.schedule.schedule_id;
		// console.log(record);

		loadData(serviceurl,"deltadata",record).success(function(data){	
			// console.log(data);
			if(data.success==true){
				toastr.success("Delete Info Successfully!");
				gettalst();
			}
		});
	}

	//teacher name hint
	$scope.getteacherList = function(current){
	    $scope.listCopy = $scope.teacherlst.slice(0);
	    if(current){
	      $scope.listCopy.push({"name":current,"new":1,"user_id":"0"});
	    }
	    return $scope.listCopy;
	};

	//add new ta row
	$scope.taassignlst = {};
	var talists = [];
	$scope.addta = function(){
		talists.push({name: "", user_id: 0, description: ""});
		// console.log(talists);
		$scope.taassignlst = talists;
	}

	//remove ta row
	$scope.removetarow = function(index){
		$scope.taassignlst.splice(index,1);
	}

	$scope.assignerr = false;
	$scope.checkmttime=function(mtdata){
		// console.log(mtdata);
		// if(event.keyCode==13){
			var record = {};
			record.userid = mtdata.user_id;
			record.scheduleid = scope.schedule.schedule_id;
			record.scheduledate = scope.schedule.schedule_date;
			record.starttime = scope.schedule.start_time;
			record.endtime = scope.schedule.end_time;
			// console.log(record);
			if(mtdata.user_id==0){

			}else{
				loadData(serviceurl,"checkmteacherasg",record).success(function(data){	
					// console.log(data);
					if(data.success==true){
						$scope.assignerr = true;
					}else{
						$scope.assignerr = false;
					}
				});
			}
			
			
		// }
	}

	$scope.selteacher=function(index,tadata){
		// console.log(index,tadata);
		$scope.taassignlst[index].name=tadata.name;
		$scope.taassignlst[index].user_id=tadata.user_id;
		$scope.taassignlst[index].description=tadata.description;
	}

	$scope.saveassignteacher=function(){
		var record = {};
		record.scheduleid = scope.schedule.schedule_id;
		record.mainteacherid = $scope.mteachersel.user_id;
		record.talst = $scope.taassignlst;
		
		// console.log(record);
		loadData(serviceurl,"addasgteachers",record).success(function(data){	
			// console.log(data);
			if(data.success==true){
				toastr.success("Teacher Assign Successfully!");
				$modalInstance.close();
				scope.getschedulelist(scope.todaydate,scope.datevale.value);
			}
		});

	}

	$scope.closecoursedialog=function(){
   		$modalInstance.close();
    }	
});


		/**************************** Schedule Detail Modal Controller ****************************/
app.controller("scheduleDetailModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Schedule_ctrl";

	$scope.title=scope.scheduledata.class_name;
	// console.log(scope.scheduledata);
	
	$scope.scheduledetail = scope.scheduledata;

	//get ta lists
	gettalst();
	$scope.tablk =false;
	function gettalst(){
		var record = {};
		record.scheduleid = scope.scheduledata.schedule_id;
		loadData(serviceurl,'gettalst',record).success(function(data){
			// console.log(data);
			$scope.talsts = data.talst;
			$scope.driverinfo = data.driverdata[0];
			getscheduledata();
		});
	}

	//get behaviour rating lists
	$scope.hidebstatus = true;
	function getscheduledata(){
		var record = {};
		record.scheduleid = scope.scheduledata.schedule_id;
		loadData(serviceurl,'getscheduledetail',record).success(function(data){
			// console.log(data);
			$scope.attenddata = data.attenddata[0];

			var totalcount = $scope.attenddata.totalcount;
			var formatbehaviour = [];
			var calavg = 0;
			if(data.attenddata[0].schedule_id!=null){
				$scope.hidebstatus = false;
				for(var i=0;i<data.bratingdata.length;i++){
					calavg = data.bratingdata[i].totalrate / totalcount;
					formatbehaviour.push({
						behaviourid:data.bratingdata[i].behaviour_id,
						description: data.bratingdata[i].description,
						totalrate:data.bratingdata[i].totalrate,
						avgrate: calavg,
						totalstu:totalcount
					})
				}
				// console.log(formatbehaviour);
				$scope.behaviourslst = formatbehaviour;
			}else{
				$scope.hidebstatus = true;
			}
			
			
		});
	}

	$scope.closecoursedialog=function(){
   		$modalInstance.close();
    }	

    //rating show
    


    $scope.ratingdetail = function(size){
    	// $scope.ratingdata = rdata; 	
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'ratingdetaildialog',
	      controller: 'ratingDetailModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
    }


});
		/**************************** Rating Detail Modal Controller ****************************/
app.controller("ratingDetailModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Schedule_ctrl";
	// console.log(scope.scheduledetail);
	$scope.scheduledetail = scope.scheduledetail;
	$scope.title = "Rating Detail";

	console.log(scope.attenddata);

	//get each studnet rating lists
	getsturatinglst();
	function getsturatinglst(){
		var record = {};
		record.scheduleid = scope.scheduledetail.schedule_id;

		$scope.restdata = [];

		var sturatingformat =[];

		loadData(serviceurl,'getsturatinglst',record).success(function(data){
			// console.log(data);
			$scope.stuabsentlst = data.stuabsentdata;

			$scope.restdata = data.ratingdata;
			console.log($scope.restdata);
			for(var i=0;i<$scope.restdata.length;i++){
				// var stuid = $scope.restdata[i].student_id;
				// console.log(stuid);
			}

			console.log(sturatingformat);
		});
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }	


});