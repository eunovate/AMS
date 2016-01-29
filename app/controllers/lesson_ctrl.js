		/**************************** Lesson List Controller ****************************/
app.controller("lesson_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData){	
	var serviceurl="Lesson_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	getlessonlist();

	function getlessonlist(){
		$scope.search="";
		loadData(serviceurl,'getlessonlist','').success(function(data){
	    	 $scope.lessons=data;
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.lessons.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredLessons = $scope.lessons.slice(begin, end);     
		});
	}
	$scope.getlessonlist=getlessonlist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.lessons.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredLessons = $scope.lessons.slice(begin, end);    
	};

	$scope.findlesson=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getlessonlist();
		    return;
		   }

		   $scope.filteredLessons=$scope.lessons; 
		}
    }

	$scope.openlessondialog = function (size) { 	
		$scope.ledit=false;
	    var lessonmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'lessondialog',
	      controller: 'LessonModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

 	$scope.openlessoneditdialog = function (l,size) { 	
	    $scope.ledit=true;
	    $scope.editlesson=l;
	    var lessonmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'lessondialog',
	      controller: 'LessonModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};
});

		/**************************** Lesson Modal Controller ****************************/
app.controller("LessonModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var defaulturl="Lesson_ctrl";
	var courseurl="Course_ctrl";

	if(scope.ledit==true){
		$scope.lesson=scope.editlesson;
		$scope.lesson.name=scope.editlesson.description;
		$scope.title="Lesson Editing";
	}
	else{
		$scope.title="Lesson Registration";
	}

	loadData(courseurl,"getcourselist",null).success(function(data){
		$scope.course=data;
		if(scope.ledit==true){
			angular.forEach($scope.course,function(val,key){
				if(val.course_id==$scope.lesson.course_id){
					$scope.courseOne=val;
				}
			});
		}
		else{
			$scope.courseOne=data[0];			
		}
	});

	$scope.savelesson=function(){
		var record={};
		record.courseid=$scope.courseOne.course_id;
		record.lesson=$scope.lesson.name;
		if(scope.ledit==false){
			loadData(defaulturl,"savelesson",record).success(function(data){	
				if(data.success==true){
					toastr.success("Lesson Registered Successfully!");
					$modalInstance.close();
					scope.getlessonlist();
				}
			});		
		}
		else{
			record.lessonid=$scope.lesson.lesson_id;
			loadData(defaulturl,"updatelesson",record).success(function(data){	
				if(data.success==true){
					toastr.success("Lesson Updated Successfully!");
					$modalInstance.close();
					scope.getlessonlist();
				}
			});			
		}
	}
	
	$scope.closelessondialog=function(){
   		$modalInstance.close();
    }	
});		