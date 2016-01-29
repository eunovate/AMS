<div class="container-fluid card" ng-controller="class_list">

   <title>Class List</title>
   <div class="header row">
      <i class="fa fa-th"></i> Class List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
              <a class="btn btn-default" ng-click="openclassdialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Class</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="findclass(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredClass.length}} | Total : {{class.length}}
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
            <th>Class Name</th>
            <th>Location</th>
            <th>Vehicle</th>   
            <th>User</th>   
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="c in filteredClass | filter:search:strict" ng-click="classlink(c.class_id)" style="cursor:pointer;">
            <td>
              <a href="" title="Active"><i class="fa fa-check i-save" ng-if="c.active_flag==true"></i></a> 
              <a href="" title="Inactive"><i class="fa fa-times i-del" ng-if="c.active_flag==false"></i></a> &nbsp;&nbsp;
              {{c.class_name}}
            </td>
            <td>{{c.location_desc}}</td>
            <td>{{c.vehicle}}</td>
            <td>{{c.user_name}}</td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredClass.length}} | Total : {{class.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <!-- Class Dialog -->
    <script type="text/ng-template" id="classdialog">
        <div class="modal-header">
            <a class="close" ng-click="closeclassdialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-th"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="classForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': classForm.classname.$invalid}">
                      <label class="control-label col-md-5" for="classname">Class Name:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="classname" ng-model="classname" ng-focus="true" required/>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': classForm.loc.$invalid}">
                      <label class="control-label col-md-5" for="loc">Location:</label>
                      <div class="controls col-md-5">
                        <div class="input-group">   
                           <select class="form-control" name="loc" ng-model="locationOne" ng-options="l.location_desc for l in location" ></select>                                                                        
                           <span class="input-group-btn">
                             <button type="button" class="btn btn-default" ng-click="openlocationdialog()"><i class="fa fa-plus" style="color:#337AB7"></i> Add</button>
                           </span>
                        </div>                      
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': classForm.bu.$invalid}">
                      <label class="control-label col-md-5" for="bu">Vehicle:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="bu" ng-model="vehicleOne" ng-options="b.v_no for b in vehicle" ></select>
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closeclassdialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="saveclass()" ng-disabled="classForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Class Dialog -->

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
                        <input type="text" class="form-control" name="locname" ng-model="location.name" ng-focus="true" ng-keyup="formenter($event)" required/>
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
</div>