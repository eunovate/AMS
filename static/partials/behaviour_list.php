<div class="container-fluid card" ng-controller="behaviour_list">

   <title>Behaviour List</title>
   <div class="header row">
      <i class="fa fa-certificate"></i> Behaviour List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
              <a class="btn btn-default" ng-click="addbdialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Behaviour</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="findclass(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredBehaviour.length}} | Total : {{behaviour.length}}
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
            <th>Behaviour Name</th>  
            <th width="20%"></th>   
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="b in filteredBehaviour | filter:search:strict">
            <td>
              <a href="" title="Active"><i class="fa fa-check i-save" ng-if="b.active_flag==true"></i></a> 
              <a href="" title="Inactive"><i class="fa fa-times i-del" ng-if="b.active_flag==false"></i></a> &nbsp;&nbsp;
              {{b.description}}
            </td>
            <td>
              <a class="btn btn-default" ng-click="editbdialog('md',b)"><i class="fa fa-edit i-edit"></i> Edit</a>
            </td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredBehaviour.length}} | Total : {{behaviour.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <!-- Class Dialog -->
    <script type="text/ng-template" id="behaviourdialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-certificate"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.behname.$invalid}">
                      <label class="control-label col-md-5" for="behname">Description:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="behname" ng-model="behname" ng-focus="true" required/>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.actstatus.$invalid}" ng-show="behedit">
                      <label class="control-label col-md-5" for="actstatus">Active:</label>
                      <div class="controls col-md-1">
                          <input type="checkbox" style="cursor:pointer;" class="form-control" name="actstatus" ng-model="actstatus"/>                        
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savebeh()" ng-disabled="dataForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Class Dialog -->

</div>