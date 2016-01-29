		/**************************** Notification List Controller ****************************/
app.controller("notification_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Notification_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	var userid = $rootScope.userid;
	getnotilst(userid);

	function getnotilst(userid){
		loadData(serviceurl,'getnotifylist',userid).success(function(data){
	    	 $scope.notilists=data;
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.notilists.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredNoti = $scope.notilists.slice(begin, end);   

		    updatenotifystatus(userid);
		});
	}
	$scope.getnotilst=getnotilst;

	//update notify status
	function updatenotifystatus(parauserid){
		loadData(serviceurl,'updatenotifystatus',parauserid).success(function(data){
			// console.log(data);
		});
	}

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.notilists.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredNoti = $scope.notilists.slice(begin, end);    
	};
 	
});