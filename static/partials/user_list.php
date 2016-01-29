<style>
/*err highlight*/
#txtErrtrue{border-color: #B94A48;}
#lblErrtrue{color:#B94A48;}
</style>

<div class="container-fluid card" ng-controller="user_list">

 <title>User List</title>
 <div class="header row">
    <i class="fa fa-user"></i> User List
    <div class="col-md-5 pull-right">
      <div class="visible-xs visible-sm"><br></div>
      <div class="input-group">
        <span class="input-group-btn">
           	<a class="btn btn-default" ng-click="openuserdialog()">
            <i class="fa fa-plus" style="color:#337AB7"></i> Add User</a>   
        </span>
        <input type="text" class="form-control" ng-model="search.$" placeholder="Search...">
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
      </div>
    </div>
  </div>

    <div class="table-responsive">
    	<table class="table table-striped table-hover" style="width:100%"> 
         <thead>
          <tr>
            <th style="text-align:center;" width="20%">Name</th>
            <th style="text-align:center;" width="20%">User Name</th>
            <th style="text-align:center;" width="20%">Group Name</th>
            <th style="text-align:center;" width="25%">Phone No</th>
            <th style="text-align:center;" width="25%">Email</th>
            <th style="text-align:center;" width="25%">Action</th>
          </tr>
        </thead>
      	<tbody>
      		<tr ng-repeat="u in user | filter:search:strict">
      		  	<td style="text-align:left;">
                  <i class="fa fa-cloud-upload" style="cursor:pointer;color:#337AB7" title="Activated" ng-show="{{u.is_active==1}}"></i>
                  <i class="fa fa-cloud-download" style="cursor:pointer;color:red" title="Deactivated" ng-show="{{u.is_active==0}}"></i>&nbsp;&nbsp;&nbsp;{{u.name}}
              </td>
              <td style="text-align:center;">{{u.user_name}} </td>
              <td style="text-align:center;">{{u.group_name}} </td>
              <td style="text-align:center;">{{u.phone}}</td>
              <td style="text-align:center;">{{u.email}}</td>
              <td style="text-align:right;">
                <div class="input-group">
                  <span class="input-group-btn">
                     <a class="btn btn-default" ng-click="openusereditdialog('',u)">
                     <i class="fa fa-pencil-square-o" style="color:#FF6C00;"></i> Edit</a>

                     <button class="btn btn-default" ng-click="openresetdialog('',u.user_id)" ng-disabled="u.user_id==1">
                     <i class="fa fa-lock"></i> Reset Password</button>
                  </span>
                </div>               
              </td>
      		</tr>
      	</tbody>
    	</table>
    </div>

   <!-- user dialog -->
    <script type="text/ng-template" id="userdialog">
            <div class="modal-header">
                <a class="close" ng-click="closeuserdialog()" data-dismiss="modal">&times;</a>
                <h3 class="modal-title"><i class="fa fa-user"></i>&nbsp; {{dialog}}</h3>
            </div>
            
            <div class="modal-body">
                <form name="userForm" class="form-horizontal backwell">    
     
                  <fieldset>
                   <div class="form-group col-md-12" ng-class="{'has-error': userForm.gname.$invalid}">
                    <label class="control-label col-md-4" for="gname">Group Name:</label>
                      <div class="controls col-md-8">
                        <select class="form-control" ng-model="groupOne" ng-options="g.group_name for g in grouplist"></select>
                      </div>    
                    </div>

                    <div class="form-group col-md-12" ng-class="{'has-error': userForm.name.$invalid}">
                        <label class="control-label col-md-4" for="name">Name :</label>
                        <div class="controls col-md-8">
                            <input type="text" class="form-control" name="name" id="name" ng-model="name" ng-focus="true" ng-keyup="formenter($event)" required/>                        
                        </div>
                    </div>

                    <div class="form-group col-md-12" ng-class="{'has-error': userForm.username.$invalid}">
                        <label class="control-label col-md-4" for="uname" id="lblErr{{isNameErr}}">User Name :</label>
                        <div class="controls col-md-8">
                            <input type="text" class="form-control" id="txtErr{{isNameErr}}" name="uname" id="uname" ng-model="username" ng-keyup="checkuser(username)" ng-disabled="disuser" required/>                           
                        </div>                        
                        <span class="col-md-2" style="margin-left: -24px;width: 20%;" ng-show="isExist" class="help-inline"><font color="#B94A48">User Exist!</font></span>                        
                    </div>

                    <div class="form-group col-md-12" ng-class="{'has-error': userForm.pass.$invalid}" ng-show="showpass">
                        <label class="control-label col-md-4" for="pass">Password :</label>
                        <div class="controls col-md-8">
                            <input type="text" class="form-control" name="pass" id="pass" ng-model="password" ng-keyup="formenter($event)" required/>                           
                        </div>                        
                    </div>

                    <div class="form-group col-md-12" ng-class="{'has-error': userForm.uemail.$invalid}">
                        <label class="control-label col-md-4" for="email">Email :</label>
                        <div class="controls col-md-8">
                            <input type="email" class="form-control" name="uemail" id="uemail" ng-model="email" ng-keyup="formenter($event)"/>                        
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4" for="phone">Phone :</label>
                        <div class="controls col-md-8">
                            <input type="text" class="form-control" name="uphone" id="uphone" ng-model="phone" ng-keyup="formenter($event)"/>                        
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4" for="gender">Gender :</label>
                        <div class="controls col-md-8">
                            <label class="radio-inline"><input type="radio" name="gendersel" ng-model="gendersel" value="1" />Male</label> 
                            <label class="radio-inline"><input type="radio" name="gendersel" ng-model="gendersel" value="2" />Female</label> 
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4" for="nrcno">NRC No. :</label>
                        <div class="controls col-md-8">
                            <input type="text" class="form-control" name="nrcno" ng-model="nrcno"/>                        
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4" for="address">Address :</label>
                        <div class="controls col-md-8">
                            <textarea class="form-control" name="address" ng-model="address"></textarea>
                        </div>
                    </div>

                  </fieldset>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default cancel" ng-click="closeuserdialog()"><i class="fa fa-times"></i> Cancel</button>
                
                <button ng-click="updatestatus()" class="btn btn-default" ng-if="deactive">
                 <i class="fa fa-cloud-upload" style="color:#337AB7"></i> Activate
                </button>

                <button ng-click="updatestatus()" class="btn btn-default" ng-if="active">
                  <i class="fa fa-cloud-download" style="color:red;"></i> Deactivate
                </button>  
                
                <button ng-click="saveuser()" ng-disabled="userForm.$invalid || isNameErr" class="btn btn-default">
                  <i class="fa fa-check-square" style="color:rgb(36, 152, 11);"></i> Save
                </button>       
            </div>
    </script><!-- end of user dialog -->

        <!-- Password Reset Dialog -->
    <script type="text/ng-template" id="resetdialog">
            <div class="modal-header">
                <a class="close" ng-click="closeresetdialog()" data-dismiss="modal">&times;</a>
                <h3  class="modal-title"><i class="fa fa-lock"></i>&nbsp; Reset Password</h3>
            </div>

            <div class="modal-body">
                <form name="resetForm" class="form-horizontal backwell">       
                   <fieldset>  

                    <div class="form-group col-md-12" ng-class="{'has-error': resetForm.resetpass.$invalid}">
                        <label class="control-label col-md-5" for="resetpass">Reset Password:</label>
                        <div class="controls col-md-5">
                            <input type="text" class="form-control" name="resetpass" id="resetpass" ng-model="passwd" 
                            ng-keyup="formenter($event)" ng-focus="true" auto-complete="off" required/>                        
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>

             <div class="modal-footer">
                <button class="btn btn-default cancel" ng-click="closeresetdialog()"><i class="fa fa-times"></i> Cancel</button>                          
                <button ng-click="resetPassword()" ng-disabled="resetForm.$invalid " class="btn btn-default"><i class="fa fa-check-square" style="color:rgb(36, 152, 11);"></i> Save</button>       
            </div>

    </script><!-- End of Password Reset Dialog -->
    
</div>