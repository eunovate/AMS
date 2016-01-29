<link href="./static/css/vehicle.css" rel="stylesheet"/>
<div class="container-fluid card" ng-controller="vehicle_dtl">
	<title>Vehicle Details</title>
    <div class="header row">
   		<i class="fa fa-car"></i> Vehicle Details 
 	</div>

	<div style="margin: 7px 0px 15px 0px;" align="left">
  		<a href="javascript:history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> <b>Back</b></a>
  		<button ng-click="openvehicleeditdialog('md')" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button>	
  	</div>

  <div class="row">
		<div class="col-md-6">
			<table class="table table-striped table-hover" style="background-color:white">
				<tr>
					<td style="width:30%">Vehicle No.:</td>
        	<td style="text-align:left;">{{vehicledtl.v_no}}</td>
				</tr>
        <tr>
          <td>Vehicle Brand:</td>
          <td>{{vehicledtl.v_brand}}</td>
        </tr>
        <tr>
          <td>Vehicle Model:</td>
          <td>{{vehicledtl.v_model}}</td>
        </tr>
        <tr>
          <td>Chassic No.:</td>
          <td>{{vehicledtl.v_chassic}}</td>
        </tr>
        <tr>
          <td>Engine No.:</td>
          <td>{{vehicledtl.v_engine}}</td>
        </tr>
        <tr>
          <td>Color:</td>
          <td>{{vehicledtl.v_color}}</td>
        </tr>
      </table>
		</div>

    <div class="col-md-6">
      <table class="table table-striped table-hover" style="background-color:white">
        <tr>
          <td>Licence Expired Date :</td>
          <td>{{vehicledtl.licence_expired_date | date:'dd-MM-yyyy'}}</td>
        </tr>
        <tr>
          <td>Bought Date :</td>
          <td>{{vehicledtl.bought_date | date:'dd-MM-yyyy'}}</td>
        </tr>     
      </table>
    </div>

	</div>

	<!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="" role="tab" data-toggle="tab"  ng-click="showvehicleusage()">
              <i class="fa fa-suitcase"></i> Vehicle Usage
          </a>
      </li>
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showmaintenance()">
          <i class="fa fa-info-circle"></i>  Maintenance Records
        </a>
      </li>  
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showschedulelst()">
          <i class="fa fa-calendar-o"></i>  Schedule
        </a>
      </li>   
    </ul>

   <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" ng-show="active==1">
      
      <!-- vehicle usage content -->
      <div class="row">     
        <div class="input-group col-xs-12 col-md-4" style="margin: 0px 0px 0px 17px; float: left;">
           <span class="input-group-btn"> 
              <button ng-click="openvehicleusagedialog('md')" class="btn btn-default" ng-disabled="btnaddusagedis"><i class="fa fa-plus i-add"></i> <b>Add Usage</b></button>   
           </span>
           <!--<input name="rsearch" class="form-control" id="rsearch" ng-model="search.$" placeholder="Search..." ng-focus="true" ng-keyup="findvehicleusage(search)"/>
           <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>-->                 
        </div>      
      </div>

      <div style="float:right;width:170px;" ng-show="vupagi">Count : {{filteredVehicleUsage.length}} | Total : {{vehicleusage.length}}</div>
      <br>

	    <div class="table-responsive">
	      <table class="table table-striped table-bordered table-hover" id="searchObjResults">
	        <thead>
	          <tr>
	            <th>Start Odometer</th>	
              <th>Start Time</th> 
              <th>End Odometer</th> 
              <th>End Time</th>            
	            <th>User</th>  
              <th></th>    
	          </tr>
	        </thead>
	        <tbody>   
	          <tr ng-repeat="v in filteredVehicleUsage | filter:search:strict">	 
	            <td>{{v.start_odometer}}</td>
	            <td>{{v.started_time | datetime}}</td>  
              <td>{{v.end_odometer}}</td>
              <td>{{v.ended_time | datetime}}</td>
              <td>{{v.createduser}}</td>   
              <td>
                <button ng-click="vudetaildialog('',v)" class="btn btn-default btn-sm"><i class="fa fa-info-circle i-add" ></i> <b>Detail</b></button> 
                <button ng-click="editvehicleusagedialog('md',v)" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button>
              </td>       
	          </tr> 
	        </tbody>  
	      </table>
	    </div>    

  	    <div align="right" ng-show="vupagi">
             <pagination boundary-links="true" total-items="totalitems" ng-model="bcurrentPage" max-size="maxSize"
               ng-change="bpageChanged()" class="pagination" 
               previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
            </pagination>   
  	    </div>
      </div>

      <div class="tab-pane fade active in" ng-show="active==2">      
        <!-- maintenance usage content -->
        <div class="row">     
          <div class="input-group col-xs-12 col-md-4" style="margin: 0px 0px 0px 17px; float: left;">
             <span class="input-group-btn"> 
                <button ng-click="openmtdialog('md')" class="btn btn-default"><i class="fa fa-plus i-add"></i> <b>Add Maintenance</b></button>   
             </span>
             <!-- <input name="rsearch" class="form-control" id="rsearch" ng-model="search.$" placeholder="Search..." ng-focus="true" ng-keyup="findvehicleusage(search)"/>
             <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span> -->                 
          </div>      
        </div>

        <div style="float:right;width:170px;" ng-show="mpagi">Count : {{filteredMaintenance.length}} | Total : {{maintenance.length}}</div>
        <br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="searchObjResults">
            <thead>
              <tr>
                <th>Timestamp</th> 
                <th>Oil</th>
                <th>Coolant</th>
                <th>Air</th>
                <th width="30%">Comment</th>                             
                <th>User</th>      
              </tr>
            </thead>
            <tbody>   
              <tr ng-repeat="m in filteredMaintenance | filter:search:strict">             
                <td>{{m.created_time | datetime}}</td>
                <td>
                  <i ng-if="m.oil==0" class="fa fa-times i-del"></i>
                  <i ng-if="m.oil==1" class="fa fa-check i-save"></i>                  
                </td>
                <td>
                  <i ng-if="m.coolant==0" class="fa fa-times i-del"></i>
                  <i ng-if="m.coolant==1" class="fa fa-check i-save"></i>                  
                </td>
                <td>
                  <i ng-if="m.air==0" class="fa fa-times i-del"></i>
                  <i ng-if="m.air==1" class="fa fa-check i-save"></i>                  
                </td>
                <td>{{m.comment}}</td>  
                <td>{{m.user_name}}</td>            
              </tr> 
            </tbody>  
          </table>
        </div>    

          <div align="right" ng-show="vupagi">
               <pagination boundary-links="true" total-items="totalitems" ng-model="mcurrentPage" max-size="maxSize"
                 ng-change="mpageChanged()" class="pagination" 
                 previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
              </pagination>   
          </div>
      </div>

      <!--tab pane 3-->
      <div class="tab-pane fade active in" ng-show="active==3">      
        <!-- vehicle schedule history content -->
        <div style="float:right;width:170px;">Count : {{filteredSchedule.length}} | Total : {{schedulelst.length}}</div>
        <br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="searchObjResults">
            <thead>
              <tr>
                <th>H Teacher</th>
                <th>Date</th>   
                <th>Course</th>   
                <th>Lesson</th>
                <th>Bus</th>
                <th width="90">Option</th>
              </tr>
            </thead>
            <tbody>   
              <tr ng-repeat="s in filteredSchedule | filter:search:strict">             
                <td>{{s.name}}</td>
                <td>
                  {{s.schedule_date | datetimeformat}} <br/>
                  {{s.start_time | timeformat}} - {{s.end_time | timeformat}}
                </td>
                <td>{{s.coursename}}</td>
                <td>{{s.lessname}}</td>
                <td>{{s.vehiclename}}</td>
                <td>
                  <button ng-click="viewdetaildialog('',s)" class="btn btn-default btn-sm"><i class="fa fa-info-circle i-add" ></i> <b>Detail</b></button> 
                </td>           
              </tr> 
            </tbody>  
          </table>
        </div>    

        <div align="right">
            <pagination boundary-links="true" total-items="totalitems" ng-model="scurrentPage" max-size="maxSize"
               ng-change="spageChanged()" class="pagination" 
               previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
            </pagination>   
        </div>
      </div>

    </div>

   <!-- Vehicle Dialog -->
    <script type="text/ng-template" id="vehicledialog">
        <div class="modal-header">
            <a class="close" ng-click="closevehicledialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-car"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="vehicleForm" class="form-horizontal backwell">       
               <fieldset>
                  <!--<div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vname.$invalid}">
                      <label class="control-label col-md-5" for="vname">Description:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="vname" ng-model="vname" required/>
                      </div>
                  </div>-->

                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vno.$invalid}">
                      <label class="control-label col-md-5" for="vno">Vehicle No.:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="vno" ng-model="vno" required/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vbrand.$invalid}">
                      <label class="control-label col-md-5" for="vbrand">Vehicle Brand:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="vbrand" ng-model="vbrand"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vmodel.$invalid}">
                      <label class="control-label col-md-5" for="vmodel">Vehicle Model:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="vmodel" ng-model="vmodel"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vchassic.$invalid}">
                      <label class="control-label col-md-5" for="vchassic">Chassic No.:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="vchassic" ng-model="vchassic"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vengine.$invalid}">
                      <label class="control-label col-md-5" for="vengine">Engine No.:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="vengine" ng-model="vengine"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vcolor.$invalid}">
                      <label class="control-label col-md-5" for="vcolor">Color:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="vcolor" ng-model="vcolor"/>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.vledate.$invalid}">
                      <label class="control-label col-md-5" for="vledate">Licence Expired Date:</label>
                      <div class="controls col-md-5">
                          <input type="date" class="form-control" name="vledate" ng-model="vledate" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.bdate.$invalid}">
                      <label class="control-label col-md-5" for="bdate">Bought Date:</label>
                      <div class="controls col-md-5">
                          <input type="date" class="form-control" name="bdate" ng-model="vboughtdate" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closevehicledialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savevehicle()" ng-disabled="vehicleForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Vehicle Dialog -->	

   <!-- Vehicle Usage Dialog -->
    <script type="text/ng-template" id="vehicleusagedialog">
        <div class="modal-header">
            <a class="close" ng-click="closevehicledialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-car"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="vehicleForm" class="form-horizontal backwell">       
               <fieldset>

                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.startodo.$invalid}">
                      <label class="control-label col-md-5" for="startodo">Start Odometer:</label>
                      <div class="controls col-md-5">
                        <div class="input-group"> 
                          <input type="text" class="form-control" name="startodo" style="text-align:right" numbers-only="numbers-only" ng-model="startodometer" ng-keyup="startodoenter($event)" required ng-disabled="btnsodomedit==true"/>
                          <span class="input-group-btn">
                             <button type="button" class="btn btn-default" ng-click="addstartodom()" ng-if="btnsodomsave==true"><span class="fa fa-check" style="color:green;"></span></button>
                             <button type="button" class="btn btn-default" ng-click="editsodom()" ng-if="btnsodomedit==true"> Edit</button>
                          </span>
                        </div>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-show="locblk">
                    <label class="control-label col-md-5" for="class">Location Lists:</label>
                    <div class="controls col-md-5">
                        <ul class="list-group">
                          <li class="list-group-item" ng-repeat="ll in loclsts">{{ll.location_desc}} 
                            <button type="button" class="btn btn-default btn-sm pull-right" style="margin-top:-4px;" ng-click="delloc(ll)"><span class="fa fa-minus" style="color:red;"></span></button>
                          </li>
                        </ul>                       
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <label class="control-label col-md-5" for="class">Add Location:</label>
                    <div class="controls col-md-5">
                      <a class="btn btn-default btn-sm" ng-click="addlocation()"><i class="fa fa-plus"></i> </a>                      
                    </div>
                  </div>
                  <div class="clearfix"></div><br/>
                  

                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.locationsel.$invalid}" ng-repeat="tl in locationlst">
                      <label for="locationsel" class="control-label col-md-5">Location:</label>
                      <div class="controls col-md-5 input-group"> 

                        <input type='text' ng-model='tl.location_desc' x-ng-focus='descFocus' typeahead='gl as gl.location_desc for gl in getlocList($viewValue) | filter:$viewValue | limitTo:10' typeahead-on-select='openlocationdialog($model,$index)' typeahead-template-url='locationTemplate.html' class='form-control' ng-keyup="locenter($event)" required >
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-default" ng-click="removelocrow($index)"><span class="fa fa-minus" style="color:red;"></span></button>
                          <button type="button" class="btn btn-default" ng-click="addloc($index)"><span class="fa fa-check" style="color:green;"></span></button>
                        </span>
                      </div>
                  </div> 

                  <div class="clearfix"></div><br/>

                  <span ng-if="hideendjobbtn==true">
                    <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="class">End Job:</label>
                      <div class="controls col-md-5">
                        <a class="btn btn-default btn-sm" ng-click="addendjob()"><i class="fa fa-plus"></i> End</a>                      
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </span>
                  

                  <div class="form-group col-md-12" ng-class="{'has-error': vehicleForm.endodo.$invalid}" ng-show="endodm">
                      <label class="control-label col-md-5" for="endodo">End Odometer:</label>
                      <div class="controls col-md-5">
                        <div class="input-group"> 
                          <input type="text" class="form-control" name="endodo" style="text-align:right" numbers-only="numbers-only" ng-model="endodometer" ng-keyup="endodoenter($event)" required ng-disabled="btneodomedit==true"/>
                          <span class="input-group-btn">
                             <button type="button" class="btn btn-default" ng-click="addendodom($index)" ng-if="btneodomsave==true"><span class="fa fa-check" style="color:green;"></span></button>
                             <button type="button" class="btn btn-default" ng-click="editeodom()" ng-if="btneodomedit==true"> Edit</button>
                          </span>
                        </div>
                      </div>
                  </div>

                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closevehicledialog()"><i class="fa fa-check i-save"></i> Done</button>                          
            <!--<button ng-click="savevehicleusage()" ng-disabled="vehicleForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button> -->      
        </div>
    </script>
    <!-- End of Vehicle Usage Dialog --> 

    <script type="text/ng-template" id="locationTemplate.html">
      <a href="">
        <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
        <!--<i>{{match.model.name}}</i>-->
        <button type="button" ng-if="match.model.new" class="btn btn-xs btn-default pull-right"><span class="fa fa-plus-circle i-add" aria-hidden="true"></span></button>
      </a>
    </script>

      <!-- location Dialog -->
    <script type="text/ng-template" id="locationdialog">
        <div class="modal-header">
            <a class="close" ng-click="closelocationdialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-th"></i>&nbsp;Location Registration</h3>
        </div>
        <div class="modal-body">
            <form name="locationForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': locationForm.locname.$invalid}">
                      <label class="control-label col-md-5" for="locname">Location Name:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="locname" ng-model="locationname" ng-focus="true" ng-keyup="formenter($event)" required/>
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closelocationdialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savelocation()" ng-disabled="locationForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of location Dialog --> 

      <!-- maintenance Dialog -->
    <script type="text/ng-template" id="maintenancedialog">
        <div class="modal-header">
            <a class="close" ng-click="closemaintenancedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-info-circle"></i>&nbsp;Maintenance Registration</h3>
        </div>
        <div class="modal-body">
            <form name="maintenanceForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="o">Oil:</label>
                      <div class="controls col-md-1">
                        <input type="checkbox" style="cursor:pointer;margin-top: 10px;"  name="ol" ng-model="maintenance.oil" ng-init="maintenance.oil=false"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="co">Coolant:</label>
                      <div class="controls col-md-1">
                        <input type="checkbox" style="cursor:pointer;margin-top: 10px;" name="co" ng-model="maintenance.coolant" ng-init="maintenance.coolant=false"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="ar">Air:</label>
                      <div class="controls col-md-1">
                        <input type="checkbox" style="cursor:pointer;margin-top: 10px;" name="ar" ng-model="maintenance.air" ng-init="maintenance.air=false"/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': maintenanceForm.cmt.$invalid}">
                      <label class="control-label col-md-5" for="cmt">Comment:</label>
                      <div class="controls col-md-5">
                         <textarea class="form-control" name="cmt" ng-focus="true" ng-model="maintenance.comment" required></textarea>
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closemaintenancedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savemaintenance()" ng-disabled="maintenanceForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of maintenance Dialog -->   

    <?php
      include "schedule_detail_tlp.php";
      include "vehicle_usage_detail_tlp.php";
    ?>       
</div>