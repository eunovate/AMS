		/**************************** Course List Controller ****************************/
app.controller("course_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Course_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	getcourselist();

	function getcourselist(){
		loadData(serviceurl,'getcourselist','').success(function(data){
	    	 $scope.courses=data;
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.courses.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredCourses = $scope.courses.slice(begin, end);     
		});
	}
	$scope.getcourselist=getcourselist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.courses.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredCourses = $scope.courses.slice(begin, end);    
	};

	$scope.findcourse=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getcourselist();
		    return;
		   }

		   $scope.filteredCourses=$scope.courses; 
		}
    }

	$scope.opencoursedialog = function (size) { 	
		$scope.cedit=false;
	    var coursemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'coursedialog',
	      controller: 'CourseModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};


 	$scope.courselink=function(id){
    	$location.path("course/"+id)
    }

 	
});

		/**************************** Course Modal Controller ****************************/
app.controller("CourseModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Course_ctrl";

	if(scope.cedit==true){
		$scope.course=scope.coursedata;
		$scope.course.name=scope.coursedata.description;
		$scope.title="Course Editing";
	}
	else{
		$scope.title="Course Registration";
	}

	$scope.savecourse=function(){
		if(scope.cedit==false){
			loadData(serviceurl,"savecourse",$scope.course).success(function(data){	
				if(data.success==true){
					toastr.success("Course Registered Successfully!");
					$modalInstance.close();
					scope.getcourselist();
				}
			});		
		}
		else{
			// console.log($scope.course);
			loadData(serviceurl,"updatecourse",$scope.course).success(function(data){	
				if(data.success==true){
					toastr.success("Course Updated Successfully!");
					$modalInstance.close();
					scope.getcoursedtl();
				}
			});			
		}
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

		/**************************** Class Details Controller ****************************/
app.controller("course_dtl", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData){
	var serviceurl="Course_ctrl";
	var courseid=$routeParams.param;
	$scope.courseid = courseid;

	$scope.active=1;
	$scope.animationsEnabled = true;

	$scope.scurrentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;

	getcoursedtl();
	function getcoursedtl(){
		loadData(serviceurl,"getcoursedtl",courseid).success(function(data){
			// console.log(data);	
			$scope.coursedata=data[0];
		});		
	}
	$scope.getcoursedtl=getcoursedtl;

	
	$scope.opencourseeditdialog = function (c,size) { 	
	    $scope.cedit=true;
	    $scope.editcourse=c;
	    var coursemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'coursedialog',
	      controller: 'CourseModalCtrl',
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
		$scope.active=1;

		var record = {};
		record.courseid = $scope.courseid;

		loadData(serviceurl,"getcourseschedulelst",record).success(function(res){
			// console.log(res);
			$scope.schedulelst=res;

		    $scope.totalitems=Math.ceil($scope.schedulelst.length / $scope.numPerPage)*10;

		          var begin = (($scope.scurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredSchedule = $scope.schedulelst.slice(begin, end); 		
		});
	}
	$scope.showschedulelst();

	
	$scope.spageChanged = function(){
		$scope.totalitems=Math.ceil($scope.schedulelst.length / $scope.numPerPage)*10;

	      var begin = (($scope.scurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredSchedule = $scope.schedulelst.slice(begin, end);    
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

});	