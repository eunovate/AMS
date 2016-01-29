		/**************************** Student List Controller ****************************/
app.controller("student_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Student_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	getstudentlist();

	function getstudentlist(){
		loadData(serviceurl,'getstudentlist','').success(function(data){
	    	 $scope.students=data;
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.students.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredStudents = $scope.students.slice(begin, end);     
		});
	}
	$scope.getstudentlist=getstudentlist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.students.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredStudents = $scope.students.slice(begin, end);    
	};

	$scope.findstudent=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getstudentlist();
		    return;
		   }

		   $scope.filteredStudents=$scope.students; 
		}
    }

    $scope.studentlink=function(id){
    	$location.path("student/"+id);
    }

	$scope.openstudentdialog = function (size){ 	
		$scope.stedit=false;
	    var studentmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'studentdialog',
	      controller: 'StudentModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};
});


		/**************************** Student Modal Controller ****************************/
app.controller("StudentModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Student_ctrl";

	if(scope.stedit==true){
		// console.log(scope.editstudent);
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
		$scope.student = {};
		$scope.student.gender = 1;
	}

	$scope.savestudent=function(){
		// console.log($scope.student);
		if(scope.stedit==false){
			loadData(serviceurl,"savestudent",$scope.student).success(function(data){	
				if(data.success==true){
					toastr.success("Student Registered Successfully!");
					$modalInstance.close();
					scope.getstudentlist();
				}
			});		
		}
		else{
			// console.log($scope.student);
			loadData(serviceurl,"updatestudent",$scope.student).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("Student Updated Successfully!");
					$modalInstance.close();
					scope.getstudentdtl();
				}
			});			
		}
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

		/**************************** Student Details Controller ****************************/
app.controller("student_dtl", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData){

	var serviceurl="Student_ctrl";
	var studentid=$routeParams.param;
	$scope.stuid = studentid;

	$scope.active=1;
	$scope.animationsEnabled = true;

	$scope.calsspagi = true;
	$scope.ccurrentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;


	/*Class Lists Section*/
  	$scope.showclasslst=function(){
		$scope.active=1;

		var record = {};
		record.studentid = studentid;

		loadData(serviceurl,"getstuclasslist",record).success(function(res){
			// console.log(res);
			$scope.classlst=res;
		    $scope.totalitems=Math.ceil($scope.classlst.length / $scope.numPerPage)*10;

		          var begin = (($scope.ccurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredClass = $scope.classlst.slice(begin, end); 		
		});
	}
	$scope.showclasslst();

	$scope.spageChanged = function(){
		$scope.totalitems=Math.ceil($scope.classlst.length / $scope.numPerPage)*10;

	      var begin = (($scope.ccurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredClass = $scope.classlst.slice(begin, end);    
	};

	$scope.showcourse=function(){
		$scope.active=2;

		loadData(serviceurl,"getstucourselist",studentid).success(function(data){
			// console.log(data);
			$scope.classcourse=data;

		    $scope.totalitems=Math.ceil($scope.classcourse.length / $scope.numPerPage)*10;

		          var begin = (($scope.ccurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredCCourse = $scope.classcourse.slice(begin, end);
		});
	}
	

	$scope.cpageChanged = function(){
		$scope.totalitems=Math.ceil($scope.classcourse.length / $scope.numPerPage)*10;

	      var begin = (($scope.ccurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredCCourse = $scope.classcourse.slice(begin, end);    
	};

	$scope.animationsEnabled = true;

	getstudentdtl();
	function getstudentdtl(){
		loadData(serviceurl,"getstudentdtl",studentid).success(function(data){	
			$scope.studentdtl=data;
		});		
	}
	$scope.getstudentdtl=getstudentdtl;

	$scope.openstudenteditdialog = function(size){ 	
	    $scope.stedit=true;
	    $scope.editstudent=$scope.studentdtl;
	    var studentmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'studentdialog',
	      controller: 'StudentModalCtrl',
	      size: size,
	      resolve: {
		        scope: function(){
		          return $scope;
		        }
   		  }
	  });
 	};

 	//for student class del modal control
	$scope.delclass = function (size,data) {
		$scope.classdata=data;

		var modalInstance = $modal.open({
		  animation: $scope.animationsEnabled,
		  templateUrl: 'coursedelContent',
		  controller: 'classdelConfirmInstanceCtrl',
		  size: size,
		  resolve:{
				scope:function(){
					return $scope;
				}
			}
		});
	}

	//for student class activate modal control
	$scope.classactive = function(size,data){
		$scope.classdata=data;

		var modalInstance = $modal.open({
		  animation: $scope.animationsEnabled,
		  templateUrl: 'coursedelContent',
		  controller: 'classactivateConfirmInstanceCtrl',
		  size: size,
		  resolve:{
				scope:function(){
					return $scope;
				}
			}
		});
	}

	//assign class dialog
 	$scope.assignclassdialog = function (size){
 		
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'assigndialog',
	      controller: 'ClassAssignModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	$scope.openbehaviourdetaildialog = function(size,data){ 	
	    $scope.studentdata=data;
	    var studentmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'behaviourdialog',
	      controller: 'behaviourDetailInstanceCtrl',
	      size: size,
	      resolve: {
		        scope: function(){
		          return $scope;
		        }
   		  }
	  });
 	};

});		
		/**************************** Student Assign Modal Controller ****************************/
app.controller("ClassAssignModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData,$filter){
	
	var serviceurl="Student_ctrl";

	$scope.title="Add Class";
	// console.log(scope.stuid);
	
	//get no class student list
	getclasslst();
	function getclasslst(){
		var record = {};
		record.stuid = scope.stuid;
		loadData(serviceurl,'getstunotclasslist',record).success(function(data){
			console.log(data);
			$scope.classlsts = data;
		});
	}

	//student name hint
	$scope.getclassList = function(current){
	    $scope.listCopy = $scope.classlsts.slice(0);
	    if(current){
	      $scope.listCopy.push({"class_name":current,"new":1,"class_id":"0"});
	    }
	    return $scope.listCopy;
	};


	$scope.selclasserror = false;
	$scope.seledclass=function(classdata){
		// console.log(classdata);
		// $scope.taassignlst[index].name=tadata.name;
		// $scope.taassignlst[index].user_id=tadata.user_id;
		// $scope.taassignlst[index].description=tadata.description;
		if(classdata.class_id!=0){
			$scope.classid = classdata.class_id;
			$scope.selclasserror = false;
		}else{
			$scope.selclasserror = true;
			$scope.classid = 0;
		}
	}

	$scope.saveassignclass=function(){
		var record = {};
		record.stuid = scope.stuid;
		record.classid = $scope.classid;

		if($scope.classid != 0 && typeof $scope.classid !='undefined'){
			console.log(record);
			loadData(serviceurl,"addassignclass",record).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("Class Added Successfully!");
					$modalInstance.close();
					scope.showclasslst();
				}
			});
		}
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }	
});

		/**************************** Class Delete from Student Modal Controller ****************************/
app.controller("classdelConfirmInstanceCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Student_ctrl";
	//modal option
	$scope.ok = function () {
		$modalInstance.close($scope.delclassdata());
	};
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	// console.log(scope.classdata);
	$scope.title = "Delete "+scope.classdata.class_name;

	$scope.delclassdata = function(){
		var record = {};
		record.stuid = scope.classdata.student_id;
		record.classid = scope.classdata.class_id;
		record.activeflag = 0;
		// console.log(record);

		loadData(serviceurl,"updateclassstatus",record).success(function(data){
			if(data.success==true){
				toastr.success("Class was Successfully Deactivated!");
				scope.showclasslst();
			}
		});
	}
})

		/**************************** Class Activate from Student Modal Controller ****************************/
app.controller("classactivateConfirmInstanceCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Student_ctrl";
	//modal option
	$scope.ok = function () {
		$modalInstance.close($scope.stuclassactive());
	};
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	// console.log(scope.classdata);
	$scope.title = "Activate "+scope.classdata.class_name;

	$scope.stuclassactive = function(){
		var record = {};
		record.stuid = scope.classdata.student_id;
		record.classid = scope.classdata.class_id;
		record.activeflag = 1;
		// console.log(record);

		loadData(serviceurl,"updateclassstatus",record).success(function(data){
			if(data.success==true){
				toastr.success("Class was Successfully Activated!");
				scope.showclasslst();
			}
		});

	}
})

	/**************************** Course Behaviour Detail for Student ****************************/
app.controller("behaviourDetailInstanceCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Student_ctrl";
	//modal option
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	console.log(scope.studentdata);
	$scope.title = "Mg Mg - Behaviour Detail";

	// $scope.delclassdata = function(){
	// 	var record = {};
	// 	record.stuid = scope.classdata.student_id;
	// 	record.classid = scope.classdata.class_id;
	// 	record.activeflag = 0;
	// 	// console.log(record);

	// 	loadData(serviceurl,"updateclassstatus",record).success(function(data){
	// 		if(data.success==true){
	// 			toastr.success("Class was Successfully Deactivated!");
	// 			scope.showclasslst();
	// 		}
	// 	});
	// }
})