<!-- Student Dialog -->
    <script type="text/ng-template" id="studentdialog">
        <div class="modal-header">
            <a class="close" ng-click="closestudentdialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-user"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="studentForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.name.$invalid}">
                      <label class="control-label col-md-5" for="name">Name:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="name" ng-focus="true" ng-model="student.name" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.ad.$invalid}">
                      <label class="control-label col-md-5" for="ad">Address:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="ad" ng-model="student.address" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div> 
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.ct.$invalid}">
                      <label class="control-label col-md-5" for="ct">Contact:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="ct" ng-model="student.contact" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div> 
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.loca.$invalid}">
                      <label class="control-label col-md-5" for="loca">Location:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="loca" ng-model="student.location" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="gen">Gender:</label>
                      <div class="controls col-md-5">
                          <label class="radio-inline"><input type="radio" name="gender" ng-model="student.gender" value="1" />Male</label> 
                          <label class="radio-inline"><input type="radio" name="gender" ng-model="student.gender" value="2" />Female</label>                         
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.dob.$invalid}">
                      <label class="control-label col-md-5" for="dob">Date of Birth:</label>
                      <div class="controls col-md-5">
                          <input type="date" class="form-control" name="dob"  ng-model="student.dateofbirth" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.nrc.$invalid}">
                      <label class="control-label col-md-5" for="nrc">NRC:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="nrc" ng-model="student.nrc" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.fname.$invalid}">
                      <label class="control-label col-md-5" for="fname">Father Name:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="fname" ng-model="student.fname" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.fnrc.$invalid}">
                      <label class="control-label col-md-5" for="fnrc">Father NRC:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="fnrc" ng-model="student.fnrc" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.mname.$invalid}">
                      <label class="control-label col-md-5" for="mname">Mother Name:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="mname" ng-model="student.mname" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.mnrc.$invalid}">
                      <label class="control-label col-md-5" for="mnrc">Mother NRC:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="mnrc" ng-model="student.mnrc" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.remark.$invalid}">
                      <label class="control-label col-md-5" for="remark">Remark:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="remark" ng-model="student.remark" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <!--<div class="form-group col-md-12" ng-class="{'has-error': studentForm.actstatus.$invalid}">
                      <label class="control-label col-md-5" for="actstatus">Active:</label>
                      <div class="controls col-md-1">
                          <input type="checkbox" style="cursor:pointer;" class="form-control" name="actstatus" ng-init="student.is_active=true" ng-model="student.is_active"/>                        
                      </div>
                  </div>-->
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closestudentdialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savestudent()" ng-disabled="studentForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Student Dialog -->