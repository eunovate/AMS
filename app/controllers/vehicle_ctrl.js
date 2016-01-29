		/**************************** Vehicle List Controller ****************************/
app.controller("vehicle_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Vehicle_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	getvehiclelist();

	function getvehiclelist(){
		loadData(serviceurl,'getvehiclelist','').success(function(data){
			// console.log(data);
	    	 $scope.vehicle=data;
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.vehicle.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredVehicle = $scope.vehicle.slice(begin, end);     
		});
	}
	$scope.getvehiclelist=getvehiclelist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.vehicle.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredVehicle = $scope.vehicle.slice(begin, end);    
	};

	$scope.findvehicle=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		getvehiclelist();
		    return;
		   }
		   $scope.filteredVehicle=$scope.vehicle; 
		}
    }

    $scope.vehiclelink=function(id){
    	$location.path("vehicle/"+id);
    }

	$scope.openvehicledialog = function (size){ 	
		$scope.bedit=false;
	    var studentmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'vehicledialog',
	      controller: 'VehicleModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};
});

		/**************************** Vehicle Modal Controller ****************************/
app.controller("VehicleModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){

	var serviceurl="Vehicle_ctrl";
	$scope.vehicle={};

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) 
	{
	  dd='0'+dd;
	} 
	if(mm<10)
	{
	  mm='0'+mm;
	} 
	$scope.vboughtdate=new Date(yyyy+'-'+mm+'-'+dd);
	$scope.vledate = new Date(yyyy+'-'+mm+'-'+dd);

	if(scope.bedit==true){
		$scope.title="Vehicle Editing";
		// console.log(scope.editvehicle);

		// $scope.vname=scope.editvehicle.description;
		$scope.vboughtdate=new Date(scope.editvehicle.bought_date);
		$scope.vledate = new Date(scope.editvehicle.licence_expired_date);
		$scope.vno=scope.editvehicle.v_no;
		$scope.vbrand=scope.editvehicle.v_brand;
		$scope.vchassic=scope.editvehicle.v_chassic;
		$scope.vengine=scope.editvehicle.v_engine;
		$scope.vmodel=scope.editvehicle.v_model;
		$scope.vcolor=scope.editvehicle.v_color;
	}
	else{
		$scope.title="Vehicle Registration";
	}

	$scope.savevehicle=function(){
		// console.log($scope.vehicle);
		var record = {};
		// record.vname = $scope.vname;
		record.bdate = $scope.vboughtdate;
		record.vledate = $scope.vledate;
		record.vno = $scope.vno;
		record.brand = $scope.vbrand;
		record.chassic = $scope.vchassic;
		record.engine = $scope.vengine;
		record.model = $scope.vmodel;
		record.color = $scope.vcolor;

		// console.log(record);
		if(scope.bedit==false){
			loadData(serviceurl,"savevehicle",record).success(function(data){	
				if(data.success==true){
					toastr.success("Vehicle Registered Successfully!");
					$modalInstance.close();
					scope.getvehiclelist();
				}
			});		
		}
		else{
			record.vid = scope.editvehicle.vehicle_id;
			loadData(serviceurl,"updatevehicle",record).success(function(data){	
				if(data.success==true){
					toastr.success("Vehicle Updated Successfully!");
					$modalInstance.close();
					scope.getvehicledtl();
				}
			});			
		}
	}

	$scope.formenter=function(event){
		if(event.keyCode==13){
			if($scope.vehicleForm.$invalid==false){
				$scope.savevehicle();
			}
		}
	}

	$scope.closevehicledialog=function(){
   		$modalInstance.close();
    }	
});


		/**************************** Vehicle Details Controller ****************************/
app.controller("vehicle_dtl", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData){
	var serviceurl="Vehicle_ctrl";
	var vehicleid=$routeParams.param;
	$scope.vehicleid=vehicleid;

	$scope.active=1;
	$scope.animationsEnabled = true;

	$scope.bcurrentPage = 1;
	$scope.mcurrentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;

	$scope.vupagi=true;
	$scope.mpagi=true;

	getvehicledtl();
	function getvehicledtl(){
		loadData(serviceurl,"getvehicledtl",vehicleid).success(function(data){
			// console.log(data);	
			$scope.vehicledtl=data;
		});		
	}
	$scope.getvehicledtl=getvehicledtl;

	/*Vehicle Usage Section*/
	$scope.showvehicleusage=function(){
		$scope.active=1;

		loadData(serviceurl,"getvehicleusage",vehicleid).success(function(data){
			// console.log(data);
			$scope.vehicleusage=data;
			$scope.latestvehicleusage = data[0];
			if($scope.latestvehicleusage){
				if($scope.latestvehicleusage.end_odometer==0){
					$scope.btnaddusagedis = true;
				}else{
					$scope.btnaddusagedis = false;
				}
			}
			
			$scope.vupagi=true;

		    $scope.totalitems=Math.ceil($scope.vehicleusage.length / $scope.numPerPage)*10;

		          var begin = (($scope.bcurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredVehicleUsage = $scope.vehicleusage.slice(begin, end);     			
		});
	}
	$scope.showvehicleusage();

	$scope.bpageChanged = function(){
		$scope.totalitems=Math.ceil($scope.vehicleusage.length / $scope.numPerPage)*10;

	          var begin = (($scope.bcurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredVehicleUsage = $scope.vehicleusage.slice(begin, end);    
	};

	// $scope.findvehicleusage=function(val){
	//     $scope.vupagi=false;
 
	//  	if(typeof val!="undefined"){
	//        if(val.$==""){
	//  		$scope.showvehicleusage();
	// 	    return;
	// 	   }

	// 	   $scope.filteredVehicleUsage=$scope.vehicleusage; 
	// 	}
 //    }

    /*Maintenance Section*/
  	$scope.showmaintenance=function(){
		$scope.active=2;

		loadData(serviceurl,"getmaintenance",vehicleid).success(function(data){
			$scope.maintenance=data;
			$scope.mpagi=true;

		    $scope.totalitems=Math.ceil($scope.maintenance.length / $scope.numPerPage)*10;

		          var begin = (($scope.mcurrentPage - 1) * $scope.numPerPage)
		    , end = begin + $scope.numPerPage;
			$scope.filteredMaintenance = $scope.maintenance.slice(begin, end);     			
		});
	}

	$scope.mpageChanged = function(){
		$scope.totalitems=Math.ceil($scope.maintenance.length / $scope.numPerPage)*10;

	          var begin = (($scope.mcurrentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredMaintenance = $scope.maintenance.slice(begin, end);    
	};

	$scope.openvehicleeditdialog = function(size){ 	
	    $scope.bedit=true;
	    $scope.editvehicle=$scope.vehicledtl;
	    var vehiclemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'vehicledialog',
	      controller: 'VehicleModalCtrl',
	      size: size,
	      resolve: {
		        scope: function(){
		          return $scope;
		        }
   		  }
	  });
 	};

	$scope.openvehicleusagedialog = function(size){ 
		$scope.vuedit=false;
	    var vehiclemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'vehicleusagedialog',
	      controller: 'VehicleUsageModalCtrl',
	      size: size,
	      resolve: {
		        scope: function(){
		          return $scope;
		        }
   		  }
	  });
 	}; 

 	$scope.editvehicleusagedialog = function(size,data){ 
		$scope.vuedit=true;
		$scope.vudata = data;
		// console.log(data);
	    var vehiclemodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'vehicleusagedialog',
	      controller: 'VehicleUsageModalCtrl',
	      size: size,
	      resolve: {
		        scope: function(){
		          return $scope;
		        }
   		  }
	  });
 	}; 

 	$scope.openmtdialog = function(size){ 
	    var mtmodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'maintenancedialog',
	      controller: 'MaintenanceModalCtrl',
	      size: size,
	      resolve: {
		        scope: function(){
		          return $scope;
		        }
   		  }
	  });
 	}; 


 	/*Sechedule Lists Section*/
  	$scope.showschedulelst=function(){
		$scope.active=3;

		var record = {};
		record.vehicleid = $scope.vehicleid;

		loadData(serviceurl,"getvehicleschedulelst",record).success(function(res){
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

 	//for vehicle detail dialog
 	$scope.vudetaildialog = function (size,sdata){
 		$scope.vudetaildata = sdata; 	
	    var datamodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'vudetaildialog',
	      controller: 'vuDetailModalCtrl',
	      size: size,
	      resolve: {
	        scope: function(){
	          return $scope;
	        }
   		  }
	  });
 	};

 	

});		
		/**************************** Vehicle Maintenance Modal Controller ****************************/
app.controller("vuDetailModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Vehicle_ctrl";

	$scope.title = "Vehicle Usage Detail";
	$scope.vudetail = scope.vudetaildata;
	// console.log(scope.vudetaildata);

	getallloclst();
	function getallloclst(){
		var record = {};
		record.vuid = scope.vudetaildata.vehicle_usage_id;
		loadData(serviceurl,'getvuallloclist',record).success(function(data){
			console.log(data);
			$scope.loclsts = data;
		});
	}

 	$scope.closedialog=function(){
   		$modalInstance.close();
    }	
});


		/**************************** Vehicle Usage Modal Controller ****************************/
app.controller("VehicleUsageModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){

	var serviceurl="Vehicle_ctrl";
	var classurl="Class_ctrl";

	$scope.animationsEnabled = true;

	getlocation();
	function getlocation(locindex){
		loadData(classurl,'getlocation','').success(function(data){
			$scope.location=data;
			if(locindex>=0){
				$scope.locationlst[locindex].location_desc=data[0].location_desc;
				$scope.locationlst[locindex].location_id=data[0].location_id;
			}
		});				
	}
	$scope.getlocation=getlocation;

	var endodometer = 0;
	if(scope.vuedit==true){
		$scope.title = "Edit Vehicle Usage";
		getloclst(scope.vudata.vehicle_usage_id);


		$scope.startodometer = scope.vudata.start_odometer;
		if(scope.vudata.end_odometer>0){
			$scope.endodm = true;
			$scope.endodometer = scope.vudata.end_odometer;
			$scope.hideendjobbtn = false;
		}else{
			$scope.hideendjobbtn = true;
			$scope.endodometer = scope.vudata.start_odometer;
		}
		$scope.vulid = scope.vudata.vehicle_usage_id;
		
	}else{
		// console.log(scope.latestvehicleusage);
		$scope.title = "Add Vehicle Usage";
		if(scope.latestvehicleusage){
			endodometer = scope.latestvehicleusage.end_odometer;
		}else{
			endodometer = 0;
		}

		$scope.startodometer = endodometer;
		$scope.endodometer = endodometer;
		$scope.endodm = false;
		$scope.hideendjobbtn = true;
		$scope.vulid = 0;
	}
	
	//process with start odom
	$scope.addstartodom = function(){
		var record={};
		record.startodom = $scope.startodometer;
		record.vehicleid = scope.vehicleid;
		record.userid=$rootScope.userid;
		if(scope.vuedit==true){
			
			if($scope.vulid >0){
				record.vuid = $scope.vulid;
			}else{
				record.vuid = scope.vudata.vehicle_usage_id;
			}
			
			loadData(serviceurl,"updatestartodom",record).success(function(data){	
				if(data.success==true){
					toastr.success("Start Odometer Updated Successfully!");
					scope.showvehicleusage();
					$scope.btnsodomsave = false;
					$scope.btnsodomedit = true;
				}
			});
		}else{
			loadData(serviceurl,"addstartodom",record).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("Start Odometer Added Successfully!");
					scope.showvehicleusage();
					$scope.vulid = data.data;
					$scope.btnsodomsave = false;
					$scope.btnsodomedit = true;
					scope.vuedit=true;
				}
			});
		}
	}

	//get vehicle usage location list
	$scope.locblk =false;
	function getloclst(vulid){
		var record = {};
		record.vuid = vulid;
		loadData(serviceurl,'getvuloclist',record).success(function(data){
			// console.log(data);
			$scope.loclsts = data;
			if(data.length>0){
				$scope.locblk =true;
			}else{
				$scope.locblk =false;
			}
		});
	}

	//process with location
	$scope.addloc = function(index){
		// console.log($scope.locationlst[index]);
		// console.log($scope.vulid);
		if($scope.locationlst[index].location_id!=0){
			var record = {};
			record.locationid = $scope.locationlst[index].location_id;
			record.vuid = $scope.vulid;
			console.log(record);
			loadData(serviceurl,"addvulocation",record).success(function(data){	
				if(data.success==true){
					toastr.success("Location was Successfully Added!");
					getloclst($scope.vulid);
					$scope.locationlst = {};
				}
			});
		}else{
			toastr.info("Select location name!");
		}
	}

	//remove location
	$scope.delloc = function(locdata){
		// console.log(locdata);
		var record = {};
		record.locid = locdata.location_id;
		if(scope.vuedit==true){
			record.vuid = scope.vudata.vehicle_usage_id;
		}else{
			record.vuid = $scope.vulid;
		}
		// console.log(record);
		loadData(serviceurl,"dellocdata",record).success(function(data){	
			if(data.success==true){
				toastr.success("Location was Successfully Deleted!");
				getloclst(record.vuid);
			}
		});
	}

	//process with end odom
	$scope.addendodom = function(){
		var record={};
		record.endodometer = $scope.endodometer;

		if(scope.vudata.end_odometer!=0){
			record.vuid = scope.vudata.vehicle_usage_id;
			loadData(serviceurl,"updateendodom",record).success(function(data){	
				if(data.success==true){
					toastr.success("End Odometer Updated Successfully!");
					scope.showvehicleusage();
					$scope.btneodomsave = false;
					$scope.btneodomedit = true;
				}
			});
		}else{
			record.vuid = $scope.vulid;
			loadData(serviceurl,"addendodom",record).success(function(data){	
				// console.log(data);
				if(data.success==true){
					toastr.success("End Odometer Added Successfully!");
					scope.showvehicleusage();
					$scope.vulid = data.data;
					$scope.btneodomsave = false;
					$scope.btneodomedit = true;
				}
			});
		}
	}

	//btn control
	$scope.btnsodomsave = true;
	$scope.btnsodomedit = false;
	$scope.editsodom = function(){
		$scope.btnsodomsave = true;
		$scope.btnsodomedit = false;
	}

	$scope.btneodomsave = true;
	$scope.btneodomedit = false;
	$scope.editeodom = function(){
		$scope.btneodomsave = true;
		$scope.btneodomedit = false;
	}
	//End btn control

	// $scope.savevehicleusage=function(){
	// 	var record={};
	// 	record.startodom = $scope.startodometer;
	// 	record.vehicleid=scope.vehicleid;
	// 	record.userid=$rootScope.userid;
	// 	record.loclst = $scope.locationlst;
	// 	record.endodom = $scope.endodometer;
		
	// 	if(scope.vuedit==true){
	// 		record.vuid = scope.vudata.vehicle_usage_id;
	// 		console.log(record);
	// 		// loadData(serviceurl,"updatevehicleusage",record).success(function(data){	
	// 		// 	if(data.success==true){
	// 		// 		toastr.success("Vehicle Usage Updated Successfully!");
	// 		// 		$modalInstance.close();
	// 		// 		scope.showvehicleusage();
	// 		// 	}
	// 		// });

	// 	}else{
	// 		console.log(record);
	// 		// loadData(serviceurl,"savevehicleusage",record).success(function(data){	
	// 		// 	if(data.success==true){
	// 		// 		toastr.success("Vehicle Usage Registered Successfully!");
	// 		// 		$modalInstance.close();
	// 		// 		scope.showvehicleusage();
	// 		// 	}
	// 		// });	
	// 	}
				
	// }

	//enter event
	//for startodometer
	$scope.startodoenter=function(event){
		if(event.keyCode==13){
			if(typeof $scope.startodometer!='undefined'){
				$scope.addstartodom();
				// console.log('reach');
			}
		}
	}

	//for location
	$scope.locenter=function(event){
		if(event.keyCode==13){
			// console.log($scope.locationlst);
			if($scope.locationlst.location_id != 0){
				$scope.addloc(0);
				// console.log('reach');
			}
		}
	}

	//for endodometer
	$scope.endodoenter=function(event){
		if(event.keyCode==13){
			if(typeof $scope.endodometer!='undefined'){
				$scope.addendodom();
				// console.log('reach');
			}
		}
	}
	//enter event finished

	$scope.openlocationdialog = function (newlocation,index) { 
		if(typeof newlocation.new != 'undefined'){
	  		$scope.newlocationdes=newlocation.location_desc;
	  		$scope.locationlstindex = index;
		    var locmodal = $modal.open({
		      animation: $scope.animationsEnabled,
		      templateUrl: 'locationdialog',
		      controller: 'vLocationModalCtrl',
		      size: 'md',
		      resolve: {
			        scope: function () {
			          return $scope;
			        }
	   		  }
		  });
	    }else{
	    	$scope.locationlst[index].location_desc = newlocation.location_desc;
	    	$scope.locationlst[index].location_id = newlocation.location_id;
	    }
 	}; 	


 	$scope.closevehicledialog=function(){
   		$modalInstance.close();
    }	

    //location name hint
	$scope.getlocList = function(current){
	    $scope.listCopy = $scope.location.slice(0);
	    if(current){
	      $scope.listCopy.push({"location_desc":current,"new":1,"location_id":"0"});
	    }
	    return $scope.listCopy;
	};

    //add new location row
	$scope.locationlst = {};
	var loclists = [];
	$scope.addlocation = function(){
		loclists[0] = {location_desc: "", location_id: 0};
		// console.log(loclists);
		$scope.locationlst = loclists;
	}

	//remove location row
	$scope.removelocrow = function(index){
		$scope.locationlst.splice(index,1);
	}

	//add end odometer
	$scope.addendjob = function(){
		$scope.endodm = true;
	}

	


});	

app.controller("vLocationModalCtrl", function($scope,$http,$modal,$modalInstance,scope,$location,loadData) {
	
	var serviceurl="Class_ctrl";
	console.log(scope.locationlstindex);
	$scope.locationname=scope.newlocationdes;

	$scope.title="Location Registration";

	$scope.savelocation=function(){
		var record = {};
		record.name=$scope.locationname;

		loadData(serviceurl,"savelocation",record).success(function(data){
			// console.log(data);
			if(data.success==true){
				scope.getlocation(scope.locationlstindex);
				toastr.success("Location Registered Successfully!");
				$modalInstance.close();
			}else{
				toastr.warning("Error Registration Location!");
			}
		});
	}

	$scope.closelocationdialog=function()
    {
   		$modalInstance.close();
    }

});	

		/**************************** Vehicle Maintenance Modal Controller ****************************/
app.controller("MaintenanceModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	var serviceurl="Vehicle_ctrl";

	$scope.savemaintenance=function(){
		var record={};
		record=$scope.maintenance;
		record.vehicleid=scope.vehicleid;
		record.userid=$rootScope.userid;
			// console.log(record);	
		loadData(serviceurl,"savemaintenance",record).success(function(data){

			if(data.success==true){
				toastr.success("Maintenance Registered Successfully!");
				$modalInstance.close();
				scope.showmaintenance();
			}
		});					
	}

 	$scope.closemaintenancedialog=function(){
   		$modalInstance.close();
    }	
});