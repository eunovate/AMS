<link href="./static/css/vehicle.css" rel="stylesheet"/>
<div class="container-fluid card" ng-controller="student_dtl">

	<title>Student Details</title>
    <div class="header row">
   		<i class="fa fa-user"></i> Student Details 
 	</div>

	<div style="margin: 7px 0px 15px 0px;" align="left">
		<a href="javascript:history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> <b>Back</b></a>
		<button ng-click="openstudenteditdialog('lg')" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button>	
	</div>

 	<div class="row">
		<div class="col-md-6">
			<table class="table table-striped table-hover" style="background-color:white">
				<tr>
					<td style="width:30%">Name :</td>
        	<td style="text-align:left;">{{studentdtl.name}}</td>
				</tr>
        <tr>
          <td>Alias :</td>
          <td>{{studentdtl.alias}}</td>
        </tr>
        <tr>
          <td>Age :</td>
          <td>{{studentdtl.age}}</td>
        </tr>
				<tr>
					<td>Gender :</td>
					<td>
            <span ng-if="studentdtl.gender==1">Male</span>
            <span ng-if="studentdtl.gender==2">Female</span>
          </td>
				</tr>
				<tr>
					<td>Date of Birth :</td>
					<td>{{studentdtl.date_of_birth | date:'dd-MM-yyyy'}}</td>
				</tr>
				<tr>
					<td>NRC No. :</td>
					<td>{{studentdtl.nrc_no}}</td>
				</tr>	
        <tr>
          <td>Nationality :</td>
          <td>{{studentdtl.nationality}}</td>
        </tr>	
        <tr>
          <td>Educational Background :</td>
          <td>{{studentdtl.education_background}}</td>
        </tr>
        <tr>
          <td>Hobbies :</td>
          <td>{{studentdtl.hobbies}}</td>
        </tr>

        <tr>
          <td>Current Job :</td>
          <td>{{studentdtl.current_job}}</td>
        </tr>
        <tr>
          <td>Post Job :</td>
          <td>{{studentdtl.post_job}}</td>
        </tr>
				
				<tr>
					<td>Remark :</td>
					<td>{{studentdtl.remark}}</td>
				</tr>			
			</table>
		</div>

		<div class="col-md-6">
			<table class="table table-striped table-hover" style="background-color:white">
				<tr>
					<td style="width:35%">Address :</td>
					<td>{{studentdtl.address}}</td>
				</tr>
				<tr>
					<td>Contact :</td>
					<td>{{studentdtl.contact}}</td>
				</tr>
				<tr>
					<td>Location :</td>
					<td>{{studentdtl.location}}</td>
				</tr>
        <tr>
          <td>Father Name :</td>
          <td>{{studentdtl.father_name}}</td>
        </tr>               
        <tr>
          <td>Father NRC No :</td>
          <td>{{studentdtl.father_nrc_no}}</td>
        </tr>
				<tr>
					<td>Mother Name :</td>
					<td>{{studentdtl.mother_name}}</td>
				</tr>	    
				<tr>
					<td>Mother NRC No :</td>
					<td>{{studentdtl.mother_nrc_no}}</td>
				</tr>	
        <tr>
          <td>Parent's Job :</td>
          <td>{{studentdtl.parent_job}}</td>
        </tr>	
        <tr>
          <td>Parent's Address :</td>
          <td>{{studentdtl.parent_address}}</td>
        </tr>		
        <tr>
          <td>Siblings Total :</td>
          <td>{{studentdtl.sibling_total}}</td>
        </tr>
				<tr>
					<td>Active :</td>
					<td>
						<a href="" title="Active"><i class="fa fa-check fa-lg i-save" ng-if="studentdtl.is_active==true"></i></a>
						<a href="" title="Inactive"><i class="fa fa-times fa-lg i-del" ng-if="studentdtl.is_active==false"></i></a>
					</td>
				</tr>									    				           			
			</table>
		</div>
	</div>


  <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="" role="tab" data-toggle="tab"  ng-click="showclasslst()">
              <i class="fa fa-th"></i> Class
          </a>
      </li>
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showcourse()">
          <i class="fa fa-book"></i> Courses
        </a>
      </li>  
    </ul>

   <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" ng-show="active==1">

        <!-- student class content -->
        <div class="row">     
          <div class="input-group col-xs-12 col-md-4" style="margin: 0px 0px 0px 17px; float: left;">
             <span class="input-group-btn"> 
                <button ng-click="assignclassdialog()" class="btn btn-default"><i class="fa fa-plus i-add"></i> <b>Add Class</b></button>   
             </span>
             <!--<input name="rsearch" class="form-control" id="rsearch" ng-model="search.$" placeholder="Search..." ng-focus="true" ng-keyup="findvehicleusage(search)"/>
             <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>-->                 
          </div>      
        </div> 

        <div style="float:right;width:170px;" ng-show="calsspagi">Count : {{filteredClass.length}} | Total : {{classlst.length}}</div>
        <br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="searchObjResults">
            <thead>
              <tr>
                <th>Class Name</th>
                <th width="25%"></th>
              </tr>
            </thead>
            <tbody>   
              <tr ng-repeat="c in filteredClass">             
                <td>{{c.class_name}}</td>
                <td align="left">
                  <button ng-click="classactive('',c)" class="btn btn-default" ng-if="c.active_flag==0">
                    <i class="fa fa-cloud-upload" style="color:#337AB7"></i> Activate
                  </button>
                  <button ng-click="delclass('',c)" class="btn btn-default" ng-if="c.active_flag==1">
                    <i class="fa fa-cloud-download" style="color:red;"></i> Deactivate
                  </button>
                </td>         
              </tr> 
            </tbody>  
          </table>
        </div>    

        <div align="right" ng-show="calsspagi">
             <pagination boundary-links="true" total-items="totalitems" ng-model="ccurrentPage" max-size="maxSize"
               ng-change="spageChanged()" class="pagination" 
               previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
            </pagination>   
        </div>
      </div>

      <div class="tab-pane fade active in" ng-show="active==2">  
 
        <div style="float:right;width:170px;">Count : {{filteredCCourse.length}} | Total : {{classcourse.length}}</div>
        <br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="searchObjResults">
            <thead>
              <tr>
                <th>Course Description</th>
                <th width="25%"></th>
              </tr>
            </thead>
            <tbody>   
              <tr ng-repeat="c in filteredCCourse">             
                <td>{{c.coursename}}</td>
                <td align="left">
                  <button ng-click="openbehaviourdetaildialog('',c)" class="btn btn-default">
                    <i class="fa fa-info-circle" style="color:#337AB7"></i> Behaviour Detail
                  </button>
                </td>         
              </tr> 
            </tbody>  
          </table>
        </div>  
        <div align="right">
          <pagination boundary-links="true" total-items="totalitems" ng-model="ccurrentPage" max-size="maxSize"
             ng-change="cpageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>
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
                  <div class="form-group col-md-12" ng-class="{'has-error': studentForm.actstatus.$invalid}">
                      <label class="control-label col-md-5" for="actstatus">Active:</label>
                      <div class="controls col-md-2">
                          <input type="checkbox" style="cursor:pointer;width:20px;" class="form-control" name="actstatus" ng-model="student.is_active"/>                        
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

    <?php
      include 'del_confirm_tpl.php';
    ?>

    <!-- Add Assign Dialog -->
    <script type="text/ng-template" id="assigndialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-check-square-o"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset> 
                  <!--<div class="col-md-12 alert alert-danger" role="alert" ng-if="selclasserror==true">
                    <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                      Main teacher already assign in this time!
                  </div>-->

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.classsel.$invalid}">
                    <label class="control-label col-md-5" for="class">Select Class:</label>
                    <div class="controls col-md-5">

                        <input type='text' ng-model='classsel' ng-focus="true" typeahead='cl as cl.class_name for cl in getclassList($viewValue) | filter:$viewValue | limitTo:10' typeahead-on-select='seledclass(classsel)' typeahead-template-url='classTemplate.html' class='form-control' required>                       
                    </div>

                  </div>
                
                </fieldset>
            </form>
        </div>

         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="saveassignclass()" ng-disabled="dataForm.$invalid || selclasserror==true" class="btn btn-default"><i class="fa fa-check i-save"></i> Add</button>       
        </div>
    </script>
    <!-- End of Assign Dialog -->

    <script type="text/ng-template" id="classTemplate.html">
      <a href="">
        <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
        <!--<i>{{match.model.name}}</i>-->
        <!--<button type="button" ng-if="match.model.new" class="btn btn-xs btn-default pull-right"><span class="fa fa-plus-circle i-add" aria-hidden="true"></span></button>-->
      </a>
    </script>

    <!-- Course Behaviour Detail Dialog -->
    <script type="text/ng-template" id="behaviourdialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <div class="col-md-12">
              <div class="col-md-6">
                
                Course Name : {{scheduledetail.coursename}} Test Course<br/>
              </div>
              <div class="clearfix"></div><br/>

              <div class="col-md-12">
                <h4>Status Detail</h4>

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Class</th>  
                        <th class="tbl_center">B1</th>
                        <th class="tbl_center">B2</th>
                        <th class="tbl_center">B3</th>
                        <th class="tbl_center">B4</th> 
                        <th class="tbl_center">B5</th>   
                      </tr>
                    </thead>
                    <tbody>   
                      <tr>
                        <td>test date</td>
                        <td>name 1</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                      </tr> 

                      <tr>
                        <td>test date</td>
                        <td>name 2</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                      </tr>


                    </tbody>  
                  </table>
                </div>

              </div>


            </div>
            <div class="clearfix"></div><br/>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Close</button>      
        </div>

    </script>
    <!-- End of Course Behaviour Detail Dialog -->
</div>