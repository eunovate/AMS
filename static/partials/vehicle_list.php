<div class="container-fluid card" ng-controller="vehicle_list">
   <title>Vehicle List</title>
   <div class="header row">
      <i class="fa fa-car"></i> Vehicle List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
             	<a class="btn btn-default" ng-click="openvehicledialog('md')">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Vehicle</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="findvehicle(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredVehicle.length}} | Total : {{vehicle.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="searchObjResults">
        <thead>
          <tr>
            <th>Vehicle No.</th>
            <th >Vehicle Brand - Model</th>
            
            <th width="20%">Bought Date</th>      
          </tr>
        </thead>
        <tbody>   
          <tr style="cursor:pointer;" ng-repeat="b in filteredVehicle | filter:search:strict" ng-click="vehiclelink(b.vehicle_id)">
            <td>{{b.v_no}}</td>
            <td>{{b.v_brand}} - {{b.v_model}}</td>
            <td>{{b.bought_date | date:'dd-MM-yyyy'}}</td>            
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredVehicle.length}} | Total : {{vehicle.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
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

</div>