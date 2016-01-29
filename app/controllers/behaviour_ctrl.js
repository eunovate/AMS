		/**************************** Behaviour List Controller ****************************/
app.controller("behaviour_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Behaviour_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	getbehaviourlist();

	function getbehaviourlist(){
		loadData(serviceurl,'getbehaviourlst','').success(function(data){
	    	 $scope.behaviour=data;
	    	 // console.log(data);
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.behaviour.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    	, end = begin + $scope.numPerPage;
		    $scope.filteredBehaviour = $scope.behaviour.slice(begin, end);     
		});
	}
	$scope.getbehaviourlist=getbehaviourlist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.behaviour.length / $scope.numPerPage)*10;

	      var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		$scope.filteredBehaviour = $scope.behaviour.slice(begin, end);    
	};

	$scope.findclass=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getbehaviourlist();
		    return;
		   }

		   $scope.filteredBehaviour=$scope.behaviour; 
		}
    }

	$scope.addbdialog = function (size) { 	
		$scope.behedit=false;
	    var coursemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'behaviourdialog',
	      controller: 'BehaviourModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

 	$scope.editbdialog = function (size,data) { 	
		$scope.behedit=true;
		$scope.behdata = data;
	    var coursemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'behaviourdialog',
	      controller: 'BehaviourModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};
});

				/**************************** Behaviour Modal Controller ****************************/
app.controller("BehaviourModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Behaviour_ctrl";
	$scope.animationsEnabled = true;

	$scope.behedit = scope.behedit;
	if(scope.behedit==true){
		$scope.title="Behaviour Editing";
		// console.log(scope.behdata);
		$scope.behname = scope.behdata.description;
		if(scope.behdata.active_flag==0){
			$scope.actstatus=false;
		}
		else{
			$scope.actstatus=true;
		}
	}
	else{
		$scope.title="Behaviour Registration";
	}
	// console.log(scope.classdtl);

	$scope.savebeh=function(){
		var record={};
		record.behname = $scope.behname;
		// console.log(record);
		if(scope.behedit==false){
			loadData(serviceurl,"addbehaviour",record).success(function(data){	
				if(data.success==true){
					toastr.success("Behaviour Registered Successfully!");
					$modalInstance.close();
					scope.getbehaviourlist();
				}
			});		
		}
		else{
			record.behid=scope.behdata.behaviour_id;
			record.activestatus = $scope.actstatus;
			// console.log(record);
			loadData(serviceurl,"updatebehaviour",record).success(function(data){	
				if(data.success==true){
					toastr.success("Behaviour Updated Successfully!");
					$modalInstance.close();
					scope.getbehaviourlist();
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

	$scope.closedialog=function(){
   		$modalInstance.close();
    }	    
});