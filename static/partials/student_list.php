<div class="container-fluid card" ng-controller="student_list">

    <title>Student List</title>
    <div class="header row">
      <i class="fa fa-user"></i> Student List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
             	<a class="btn btn-default" ng-click="openstudentdialog('lg')">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Student</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="findstudent(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredStudents.length}} | Total : {{students.length}}
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
            <th>Name</th>
            <th>Alias</th> 
            <th>Address</th>
            <th>Date of Birth</th> 
            <th>Contact</th>
            <th>Location</th>      
            <th>NRC No</th>       
          	<th>Remark</th>   
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="s in filteredStudents | filter:search:strict" style="cursor:pointer;" ng-click="studentlink(s.student_id)">
            <td>
              <a href="" title="Active"><i class="fa fa-check i-save" ng-if="s.is_active==true"></i></a> 
              <a href="" title="Inactive"><i class="fa fa-times i-del" ng-if="s.is_active==false"></i></a> &nbsp;&nbsp;{{s.name}}
            </td>
            <td>{{s.alias}}</td>
            <td>{{s.address}}</td>
            <td>{{s.date_of_birth | date:'dd-MM-yyyy'}}</td>
            <td>{{s.contact}}</td> 
            <td>{{s.location}}</td> 
            <td>{{s.nrc_no}}</td>      
            <td>{{s.remark}}</td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredStudents.length}} | Total : {{students.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <!-- Student Dialog -->
    <script type="text/ng-template" id="studentdialog">
        <div class="modal-header">
            <a class="close" ng-click="closestudentdialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-user"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="studentForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="col-md-6">

                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.name.$invalid}">
                      <label class="control-label col-md-6" for="name">Name:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="name" ng-focus="true" ng-model="student.name" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.salias.$invalid}">
                      <label class="control-label col-md-6" for="salias">Alias:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="salias" ng-model="student.alias" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.sage.$invalid}">
                      <label class="control-label col-md-6" for="sage">Age:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="sage" ng-model="student.age" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.nationality.$invalid}">
                      <label class="control-label col-md-6" for="nationality">Nationality:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="nationality" ng-model="student.nationality" ng-keyup="formenter($event)"/>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.ad.$invalid}">
                      <label class="control-label col-md-6" for="ad">Address:</label>
                      <div class="controls col-md-6">
                          <textarea class="form-control" name="ad" ng-model="student.address" ng-keyup="formenter($event)"/></textarea>                       
                      </div>
                  </div> 
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.ct.$invalid}">
                      <label class="control-label col-md-6" for="ct">Contact:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="ct" ng-model="student.contact" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div> 
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.loca.$invalid}">
                      <label class="control-label col-md-6" for="loca">Location:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="loca" ng-model="student.location" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.gen.$invalid}">
                      <label class="control-label col-md-6" for="gen">Gender:</label>
                      <div class="controls col-md-6">
                          <!--<input type="text" class="form-control" name="gen" ng-model="student.gender" ng-keyup="formenter($event)" required/>  -->
                          <label class="radio-inline"><input type="radio" name="gen" ng-model="student.gender" value="1" />Male</label> 
                          <label class="radio-inline"><input type="radio" name="gen" ng-model="student.gender" value="2" />Female</label>                       
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.dob.$invalid}">
                      <label class="control-label col-md-6" for="dob">Date of Birth:</label>
                      <div class="controls col-md-6">
                          <input type="date" class="form-control" name="dob"  ng-model="student.dateofbirth" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.nrc.$invalid}">
                      <label class="control-label col-md-6" for="nrc">NRC:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="nrc" ng-model="student.nrc" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.eb.$invalid}">
                      <label class="control-label col-md-6" for="eb">Educational Background:</label>
                      <div class="controls col-md-6">
                          <textarea class="form-control" name="eb" ng-model="student.education_background"></textarea>   
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.hobbies.$invalid}">
                      <label class="control-label col-md-6" for="hobbies">Hobbies:</label>
                      <div class="controls col-md-6">
                          <textarea class="form-control" name="hobbies" ng-model="student.hobbies"></textarea>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.cjob.$invalid}">
                      <label class="control-label col-md-6" for="cjob">Current Job:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="cjob" ng-model="student.current_job" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.pjob.$invalid}">
                      <label class="control-label col-md-6" for="pjob">Post Job:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="pjob" ng-model="student.post_job" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>

                </div>

                <div class="col-md-6" style="padding-right:0;padding-left:0;">
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.fname.$invalid}">
                      <label class="control-label col-md-5" for="fname">Father Name:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="fname" ng-model="student.fname" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.fnrc.$invalid}">
                      <label class="control-label col-md-5" for="fnrc">Father NRC:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="fnrc" ng-model="student.fnrc" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.mname.$invalid}">
                      <label class="control-label col-md-5" for="mname">Mother Name:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="mname" ng-model="student.mname" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.mnrc.$invalid}">
                      <label class="control-label col-md-5" for="mnrc">Mother NRC:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="mnrc" ng-model="student.mnrc" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.parentjob.$invalid}">
                      <label class="control-label col-md-5" for="parentjob">Parent's Job:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="parentjob" ng-model="student.parent_job" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.paddress.$invalid}">
                      <label class="control-label col-md-5" for="paddress">Parent's Address:</label>
                      <div class="controls col-md-6">
                          <textarea class="form-control" name="paddress" ng-model="student.parent_address"> </textarea>                       
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.stotal.$invalid}">
                      <label class="control-label col-md-5" for="stotal">Sibling Total:</label>
                      <div class="controls col-md-6">
                          <input type="text" class="form-control" name="stotal" ng-model="student.sibling_total" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.remark.$invalid}">
                      <label class="control-label col-md-5" for="remark">Remark:</label>
                      <div class="controls col-md-6">
                          <textarea class="form-control" name="remark" ng-model="student.remark"></textarea>
                      </div>
                  </div>

                </div>
                  
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closestudentdialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savestudent()" ng-disabled="studentForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Student Dialog -->

</div>