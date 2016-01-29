		/**************************** Class List Controller ****************************/
app.controller("class_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Class_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	getclasslist();

	function getclasslist(){
		loadData(serviceurl,'getclasslist','').success(function(data){
	    	 $scope.class=data;
	    	 // console.log(data);
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.class.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    	, end = begin + $scope.numPerPage;
		    $scope.filteredClass = $scope.class.slice(begin, end);     
		});
	}
	$scope.getclasslist=getclasslist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.class.length / $scope.numPerPage)*10;

	      var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredClass = $scope.class.slice(begin, end);    
	};

	$scope.findclass=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getclasslist();
		    return;
		   }

		   $scope.filteredClass=$scope.class; 
		}
    }

    $scope.classlink=function($id){
    	$location.path("class/"+$id)
    }

	$scope.openclassdialog = function (size) { 	
		$scope.cedit=false;
	    var coursemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'classdialog',
	      controller: 'ClassModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};
});

				/**************************** Class Modal Controller ****************************/
app.controller("ClassModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Class_ctrl";
	/*var courseurl="Course_ctrl";*/
	var vehicleurl="Vehicle_ctrl";
	$scope.animationsEnabled = true;

	if(scope.cedit==true){
		$scope.title="Class Editing";
		// console.log(scope.editclass);
		if(scope.editclass.active_flag==0){
			$scope.actstatus=false;
		}
		else{
			$scope.actstatus=true;
		}
	}
	else{
		$scope.title="Class Registration";
	}
	// console.log(scope.classdtl);

	getlocation();
	function getlocation(){
		loadData(serviceurl,'getlocation','').success(function(data){
			$scope.location=data;

			if(scope.cedit==true){
				$scope.classname = scope.classdtl.class_name;
				angular.forEach($scope.location,function(val,key){
					if(val.location_id==scope.classdtl.location_id){
						$scope.locationOne=val;
					}
				});
			}
			else{
				$scope.locationOne=data[0];
			}		
		});		
	}
	$scope.getlocation=getlocation;


	loadData(vehicleurl,'getvehiclelist','').success(function(data){
		$scope.vehicle=data;

		if(scope.cedit==true){
			angular.forEach($scope.vehicle,function(val,key){
				if(val.vehicle_id==scope.classdtl.vehicle_id){
					$scope.vehicleOne=val;
				}
			});
		}
		else{
			$scope.vehicleOne=data[0];
		}					
	});

	$scope.saveclass=function(){
		var record={};
		record.classname = $scope.classname;
		record.locationid=$scope.locationOne.location_id;
		record.vehicleid=$scope.vehicleOne.vehicle_id;
		record.createduserid = $rootScope.userid;
		// console.log(record);
		if(scope.cedit==false){
			loadData(serviceurl,"saveclass",record).success(function(data){	
				if(data.success==true){
					toastr.success("Class Registered Successfully!");
					$modalInstance.close();
					scope.getclasslist();
				}
			});		
		}
		else{
			record.classid=scope.classdtl.class_id;
			record.activestatus = $scope.actstatus;
			// console.log(record);
			loadData(serviceurl,"updateclass",record).success(function(data){	
				if(data.success==true){
					toastr.success("Class Updated Successfully!");
					$modalInstance.close();
					scope.getclassdtl();
				}
			});			
		}
	}

	$scope.formenter=function(event){
		if(event.keyCode==13){
			if($scope.classForm.$invalid==false){
				$scope.saveclass();
			}
		}
	}

	$scope.closeclassdialog=function(){
   		$modalInstance.close();
    }	

	$scope.openlocationdialog = function (size) { 	
	    var locmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'locationdialog',
	      controller: 'LocationModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};    
});


		/**************************** Class Details Controller ****************************/
app.controller("class_dtl", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData){
	var serviceurl="Class_ctrl";
	var classid=$routeParams.param;
	$scope.classid = classid;

	$scope.active=1;
	$scope.animationsEnabled = true;

	$scope.ccurrentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;

	getclassdtl();
	function getclassdtl(){
		loadData(serviceurl,"getclassdtl",classid).success(function(data){	
			$scope.classdtl=data;
		});		
	}
	$scope.getclassdtl=getclassdtl;

	$scope.showcourse=function(){
		$scope.active=1;

		loadData(serviceurl,"getclasscourse",classid).success(function(data){
			$scope.classcourse=data;

		    $scope.totalitems=Math.ceil($scope.classcourse.length / $scope.numPerPage)*10;

		          var begin = (($scope.ccurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredCCourse = $scope.classcourse.slice(begin, end);
		});
	}
	$scope.showcourse();

	$scope.cpageChanged = function(){
		$scope.totalitems=Math.ceil($scope.classcourse.length / $scope.numPerPage)*10;

	      var begin = (($scope.ccurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredCCourse = $scope.classcourse.slice(begin, end);    
	};

	$scope.openclasseditdialog = function(size){ 	
	    $scope.cedit=true;
	    $scope.editclass=$scope.classdtl;
	    var classmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'classdialog',
	      controller: 'ClassModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};


 	$scope.opencoursedialog = function (size) { 	
		$scope.cedit=false;
	    var coursemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'coursedialog',
	      controller: 'CourseVClassModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};


 	/*Sechedule Lists Section*/
  	$scope.showschedulelst=function(){
		$scope.active=2;

		var record = {};
		record.classid = $scope.classid;

		loadData(serviceurl,"getclassschedulelst",record).success(function(res){
			$scope.schedulelst=res;

		    $scope.totalitems=Math.ceil($scope.schedulelst.length / $scope.numPerPage)*10;

		          var begin = (($scope.scurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredSchedule = $scope.schedulelst.slice(begin, end); 		
		});
	}

	$scope.scurrentPage = 1;
	$scope.spageChanged = function(){
		$scope.totalitems=Math.ceil($scope.schedulelst.length / $scope.numPerPage)*10;

	      var begin = (($scope.scurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredSchedule = $scope.schedulelst.slice(begin, end);    
	};

	/*Student Lists Section*/
  	$scope.showstudentlst=function(){
		$scope.active=3;
		$scope.stupagi=true;
		var record = {};
		record.classid = $scope.classid;

		loadData(serviceurl,"getclassstulst",record).success(function(stures){
			$scope.studnetlst=stures;
		    $scope.totalitems=Math.ceil($scope.studnetlst.length / $scope.numPerPage)*10;

		          var begin = (($scope.stucurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredStudent = $scope.studnetlst.slice(begin, end); 		
		});
	}

	$scope.stucurrentPage = 1;
	$scope.stupageChanged = function(){
		$scope.totalitems=Math.ceil($scope.studnetlst.length / $scope.numPerPage)*10;

	      var begin = (($scope.stucurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredStudent = $scope.studnetlst.slice(begin, end);    
	};

	//search student name
	$scope.findstudent=function(val){
	    $scope.stupagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		$scope.showstudentlst();
		    return;
		   }

		   $scope.filteredStudent=$scope.studnetlst; 
		}
    }

	

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


 	//for course del modal control
	$scope.delcourse = function (size,data) {
		$scope.coursedata=data;

		var modalInstance = $modal.open({
		  animation: $scope.animationsEnabled,
		  templateUrl: 'coursedelContent',
		  controller: 'coursedelConfirmInstanceCtrl',
		  size: size,
		  resolve:{
				scope:function(){
					return $scope;
				}
			}
		});
	}

	//course activate
	$scope.courseactive = function(size,data){
		$scope.coursedata=data;

		var modalInstance = $modal.open({
		  animation: $scope.animationsEnabled,
		  templateUrl: 'coursedelContent',
		  controller: 'courseactivateConfirmInstanceCtrl',
		  size: size,
		  resolve:{
				scope:function(){
					return $scope;
				}
			}
		});
	}

	//add student dialog
	$scope.openstudentdialog = function (size){ 	
		$scope.stedit=false;
	    var studentmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'studentdialog',
	      controller: 'StudentClassModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	//assign student dialog
 	$scope.assignstudialog = function (size){
 		
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'assigndialog',
	      controller: 'studentAssignModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

});	
		/**************************** Course Activate from Class Modal Controller ****************************/
app.controller("courseactivateConfirmInstanceCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Class_ctrl";
	//modal option
	$scope.ok = function () {
		$modalInstance.close($scope.classcourseactive());
	};
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	// console.log(scope.coursedata);
	$scope.title = "Activate "+scope.coursedata.description;
	$scope.actiontext = 'activate';

	$scope.classcourseactive = function(){
		var record = {};
		record.classid = scope.classid;
		record.courseid = scope.coursedata.course_id;
		record.activeflag = 1;
		// console.log(record);

		loadData(serviceurl,"updatecoursestatus",record).success(function(data){
			if(data.success==true){
				toastr.success("Course was Successfully Activated!");
				scope.showcourse();
			}
		});

	}
})

				/**************************** Student Assign Modal Controller ****************************/
app.controller("studentAssignModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Class_ctrl";

	$scope.title="Student Assign";
	console.log(scope.classid);
	
	//get no class student list
	getstudentlst();
	function getstudentlst(){
		loadData(serviceurl,'getnclassstulst','').success(function(data){
			console.log(data);
			$scope.studentslst = data;
		});
	}

	//student name hint
	$scope.getstudentList = function(current){
	    $scope.listCopy = $scope.studentslst.slice(0);
	    if(current){
	      $scope.listCopy.push({"name":current,"new":1,"student_id":"0"});
	    }
	    return $scope.listCopy;
	};


	$scope.selstuerror = false;
	$scope.seledstudent=function(studata){
		console.log(studata);
		// $scope.taassignlst[index].name=tadata.name;
		// $scope.taassignlst[index].user_id=tadata.user_id;
		// $scope.taassignlst[index].description=tadata.description;
		if(studata.student_id!=0){
			$scope.stuid = studata.student_id;
			$scope.selstuerror = false;
		}else{
			$scope.selstuerror = true;
			$scope.stuid = 0;
		}
	}

	$scope.saveassignstudent=function(){
		var record = {};
		record.classid = scope.classid;
		record.studentid = $scope.stuid;

		if($scope.stuid != 0 && typeof $scope.stuid !='undefined'){
			console.log(record);
			loadData(serviceurl,"addassignstudent",record).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("Student Assign Successfully!");
					$modalInstance.close();
					scope.showstudentlst();
				}
			});
		}
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }	
});

				/**************************** Course Delete from Class Modal Controller ****************************/
app.controller("coursedelConfirmInstanceCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Class_ctrl";
	//modal option
	$scope.ok = function () {
		$modalInstance.close($scope.delcoursedata());
	};
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	// console.log(scope.coursedata);
	$scope.title = "Delete "+scope.coursedata.description;
	$scope.actiontext = 'deactivate';

	$scope.delcoursedata = function(){
		var record = {};
		record.classid = scope.classid;
		record.courseid = scope.coursedata.course_id;
		record.activeflag = 0;
		// console.log(record);

		loadData(serviceurl,"updatecoursestatus",record).success(function(data){
			if(data.success==true){
				toastr.success("Course was Successfully Deactivated!");
				scope.showcourse();
			}
		});
	}
})

		/**************************** Student Class Modal Controller ****************************/
app.controller("StudentClassModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Class_ctrl";
	$scope.student = {};
	if(scope.stedit==true){
		$scope.student=angular.copy(scope.editstudent);
		$scope.student.dateofbirth=new Date(scope.editstudent.date_of_birth);
		$scope.student.nrc=scope.editstudent.nrc_no;
		$scope.student.fname=scope.editstudent.father_name;
		$scope.student.fnrc=scope.editstudent.father_nrc_no;
		$scope.student.mname=scope.editstudent.mother_name;
		$scope.student.mnrc=scope.editstudent.mother_nrc_no;
		$scope.student.remark=scope.editstudent.remark;

		if(scope.editstudent.is_active==0){
			$scope.student.is_active=false;
		}
		else{
			$scope.student.is_active=true;
		}

		$scope.title="Student Editing";
	}
	else{
		$scope.title="Student Registration";
		$scope.student.gender = 1;
	}

	$scope.savestudent=function(){
		var record = {};
		record.studentname = $scope.student.name;
		record.address = $scope.student.address;
		record.contact = $scope.student.contact;
		record.location = $scope.student.location;
		record.gender = $scope.student.gender;
		record.dob = $filter('date')($scope.student.dateofbirth, "yyyy-MM-dd");
		record.nrc = $scope.student.nrc;
		record.fathername = $scope.student.fname;
		record.fathernrc = $scope.student.fnrc;
		record.mothername = $scope.student.mname;
		record.mothernrc = $scope.student.mnrc;
		record.remark = $scope.student.remark;
		record.classid = scope.classid;

		// console.log(record);
		if(scope.stedit==false){
			loadData(serviceurl,"addnewstu",record).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("New Student Registered Successfully!");
					$modalInstance.close();
					scope.showstudentlst();
				}
			});		
		}
		// else{
		// 	loadData(serviceurl,"updatestudent",$scope.student).success(function(data){	
		// 		if(data.success==true){
		// 			toastr.success("Student Updated Successfully!");
		// 			$modalInstance.close();
		// 			scope.getstudentdtl();
		// 		}
		// 	});			
		// }
	}

	$scope.formenter=function(event){
		if(event.keyCode==13){
			if($scope.studentForm.$invalid==false){
				$scope.savestudent();
			}
		}
	}

	$scope.closestudentdialog=function(){
   		$modalInstance.close();
    }	
});

				/**************************** Location Modal Controller ****************************/
app.controller("LocationModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Class_ctrl";

	$scope.savelocation=function(){
		loadData(serviceurl,"savelocation",$scope.location).success(function(data){
			if(data.success==true){
				toastr.success("Location Saved Successfully!");
				$modalInstance.close();
				scope.getlocation();
			}
		});		
	}

	$scope.closelocationdialog=function(){
   		$modalInstance.close();
    }	
});			

			/**************************** Course Modal Controller ****************************/
app.controller("CourseVClassModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Course_ctrl";

	if(scope.cedit==true){
		$scope.course=scope.editcourse;
		$scope.course.name=scope.editcourse.description;
		$scope.title="Course Editing";
	}
	else{
		$scope.title="Course Registration";
	}

	$scope.savecourse=function(){
		var record = {};
		record.coursename = $scope.course.name;
		record.classid = scope.classid;
		console.log(record);
		if(scope.cedit==false){
			loadData(serviceurl,"addcoursedata",record).success(function(data){	
				if(data.success==true){
					toastr.success("Course Registered Successfully!");
					$modalInstance.close();
					scope.showcourse();
				}
			});		
		}
		// else{
		// 	loadData(serviceurl,"updatecourse",$scope.course).success(function(data){	
		// 		if(data.success==true){
		// 			toastr.success("Course Updated Successfully!");
		// 			$modalInstance.close();
		// 			scope.showcourse();
		// 		}
		// 	});			
		// }
	}

	$scope.formenter=function(event){
		if(event.keyCode==13){
			if($scope.courseForm.$invalid==false){
				$scope.savecourse();
			}
		}
	}

	$scope.closecoursedialog=function(){
   		$modalInstance.close();
    }	
});