<div class="container-fluid card" ng-controller="user_group_list">
	<title>User Group List</title>
	<div class="header row">
		<i class="fa fa-users"></i>&nbsp;User Group List
		<div class="col-md-5 pull-right">
			<div class="visible-xs visible-sm"><br></div>
			<div class="input-group">
				<span class="input-group-btn">
					<a class="btn btn-default" ng-click="opengroupdialog('md')"><i class="fa fa-plus" style="color:#337AB7"></i> Add User Group</a> 
				</span>
				<input type="text" class="form-control" placeholder="Search... " ng-model="search.$">
				<span class="input-group-addon"><i class="fa fa-search"></i></span>
			</div>
		</div>
	</div>

  <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th width="40%">Group Name</th>
            <th width="20%">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="g in grouplist | filter:search:strict">
              <td><i class="fa fa-cloud-upload" style="cursor:pointer;color:#337AB7" title="Activated" ng-show="{{g.active_flag==1}}"></i>
			         	<i class="fa fa-cloud-download" style="cursor:pointer;color:red" title="Deactivated" ng-show="{{g.active_flag==0}}"></i>&nbsp;{{g.group_name}}</td>
              <td>
             	  <button ng-click="openuserdetaildialog(g,'md')" class="btn btn-default"><i class="fa fa-info i-add"></i> Details</button>	
                <button ng-click="opengroupeditdialog(g,'md')" class="btn btn-default"><i class="fa fa-edit i-edit"></i> Edit</button>	              	
              </td>
          </tr>
        </tbody>
      </table>
  </div>

     <!-- User Group Dialog -->
  <script type="text/ng-template" id="groupdialog">
    <div class="modal-header">
        <a class="close" ng-click="closegroupdialog()" data-dismiss="modal">&times;</a>
        <h3  class="modal-title"><i class="fa fa-users"></i> {{title}}</h3>
    </div>    
    <div class="modal-body">
        <form name="groupForm" class="form-horizontal backwell">       
           <fieldset>  
              <div class="form-group col-md-12" ng-class="{'has-error': groupForm.name.$invalid}">
                  <label class="control-label col-md-5" for="name">Group Name :</label>
                  <div class="controls col-md-5">
                      <input type="text" class="form-control" name="name" id="name" ng-model="gpname" ng-focus="true" required/>                        
                  </div>
              </div>
              <div class="form-group col-md-12" ng-class="{'has-error': userForm.urole.$invalid}">
                  <label class="control-label col-md-5" for="urole">Role:</label>
                  <div class="controls col-md-5">
                    <select class="form-control" name="urole" ng-model="roleOne" ng-options="r.description for r in role" ></select>
                  </div>
              </div>

              <div class="form-group col-md-12" ng-class="{'has-error': userForm.permission.$invalid}">
                  <label class="control-label col-md-4" for="permission">Permission :</label>
                  <div class="controls col-md-8">
                    <table class="table" style="font-size:14px;">
                      <tr>
                        <td>Student:</td>
                        <td><select ng-model="pcustOne" style="width: 160px;"  class="form-control" ng-options="u.name for u in pcustomer" required></select></td>
                      </tr>
                      <tr>
                        <td>Class:</td>
                        <td><select ng-model="pcarOne" style="width: 160px;"  class="form-control" ng-options="u.name for u in pcar" required></select></td>
                      </tr>   
                    </table>                     
                  </div>
              </div>                 
              
            </fieldset>
        </form>
    </div>    
    <div class="modal-footer">
        <button class="btn btn-default cancel" ng-click="closegroupdialog()"><i class="fa fa-times"></i> Cancel</button>

        <button ng-click="updatestatus()" class="btn btn-default" ng-if="deactive">
         <i class="fa fa-cloud-upload" style="color:#337AB7"></i> Activate
        </button>

        <button ng-click="updatestatus()" class="btn btn-default" ng-if="active">
          <i class="fa fa-cloud-download" style="color:red;"></i> Deactivate
        </button>          
        
        <button ng-click="saveuser()" ng-disabled="groupForm.$invalid" class="btn btn-default">
          <i class="fa fa-check-square" style="color:rgb(36, 152, 11);"></i> Save
        </button>       
    </div>
  </script>


    <!-- User Details Dialog -->
  <script type="text/ng-template" id="UserDetailDialog">
    
    <div class="modal-header">
      <a class="close" ng-click="closeUserDetailDialog()" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"><i class="fa fa-user"></i>&nbsp;User Details</h3>
      </div>
      
      <div class="modal-body">
        <table class="table table-striped table-hover" style="width:100%"> 
           <thead>
            <tr>
              <th style="text-align:center;" width="20%">Name</th>
              <th style="text-align:center;" width="20%">User Name</th>
              <th style="text-align:center;" width="25%">Phone No</th>
              <th style="text-align:center;" width="25%">Email</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="u in user | filter:search:strict">
                <td style="text-align:left;">
                    <i class="fa fa-cloud-upload" style="cursor:pointer;color:#337AB7" title="Activated" ng-show="{{u.is_active==1}}"></i>
                    <i class="fa fa-cloud-download" style="cursor:pointer;color:red" title="Deactivated" ng-show="{{u.is_active==0}}"></i>&nbsp;&nbsp;&nbsp;{{u.name}}
                </td>
                <td style="text-align:center;">{{u.user_name}} </td>
                <td style="text-align:center;">{{u.phone}}</td>
                <td style="text-align:center;">{{u.email}}</td>
            </tr>
          </tbody>
        </table>     
       </div>

    <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closeUserDetailDialog()"><i class="fa fa-remove "></i>&nbsp;Cancel</button>
    </div>
    </script>
</div> 