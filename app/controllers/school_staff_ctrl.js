		/**************************** Vehicle Details Controller ****************************/
app.controller("staff_dtl", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData){
	var serviceurl="Staff_ctrl";
	var staffid=$routeParams.param;
	$scope.staffid=staffid;

	$scope.active=1;
	$scope.animationsEnabled = true;

	$scope.scurrentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;

	$scope.vupagi=true;

	//get path
	$scope.getpath = function(){
		var path = $location.path();
		var splitpath = path.split("/");
		return splitpath[1];
	}

	//title check
	function stafftitle(){
		var titleval = $scope.getpath();
		// console.log(titleval);
		if(titleval=='teacher'){
			$scope.title = "Teacher";
		}else if(titleval=='driver'){
			$scope.title = "Driver";
		}
	}
	stafftitle();

	// getstaffdtl();
	// function getstaffdtl(){
	// 	loadData(serviceurl,"getstaffdtl",staffid).success(function(data){	
	// 		$scope.vehicledtl=data;
	// 	});		
	// }
	// $scope.getstaffdtl=getstaffdtl;

 	/*Sechedule Lists Section*/
  	$scope.showschedulelst=function(){
		$scope.active=1;

		var record = {};
		record.staffid = $scope.staffid;

		loadData(serviceurl,"getstaffschedulelst",record).success(function(res){
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