<link href="./static/css/vehicle.css" rel="stylesheet"/>
<div class="container-fluid card" ng-controller="class_dtl">
	<title>Class Details</title>
    <div class="header row">
   		<i class="fa fa-th"></i> Class Details 
 	</div>

	<div style="margin: 7px 0px 15px 0px;" align="left">
  		<a href="javascript:history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> <b>Back</b></a>
  		<button ng-click="openclasseditdialog('md')" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button>	
  	</div>

  	 <div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-hover" style="background-color:white">
        <tr>
          <td>Class Name :</td>
          <td style="text-align:left;">{{classdtl.class_name}}</td>
        </tr>
				<tr>
					<td style="width:15%">Location :</td>
					<td style="text-align:left;">{{classdtl.location_desc}}</td>
				</tr>
        <tr>
          <td>Vehicle :</td>
          <td>{{classdtl.vehicle}}</td>
        </tr>    		
        <tr>
          <td>User Name :</td>
          <td>{{classdtl.user_name}}</td>
        </tr> 
        <tr>
          <td>Active :</td>
          <td>
            <a href="" title="Active"><i class="fa fa-check fa-lg i-save" ng-if="classdtl.active_flag==true"></i></a>
            <a href="" title="Inactive"><i class="fa fa-times fa-lg i-del" ng-if="classdtl.active_flag==false"></i></a>
          </td>
        </tr>          	
			</table>
		</div>
	</div>

	<!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="" role="tab" data-toggle="tab"  ng-click="showcourse()">
              <i class="fa fa-book"></i> Courses
          </a>
      </li>  
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showschedulelst()">
          <i class="fa fa-calendar-o"></i>  Schedule
        </a>
      </li>
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showstudentlst()">
          <i class="fa fa-user"></i>  Student
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
                <button ng-click="opencoursedialog()" class="btn btn-default"><i class="fa fa-plus i-add"></i> <b>Add Course</b></button>   
             </span>
             <!--<input name="rsearch" class="form-control" id="rsearch" ng-model="search.$" placeholder="Search..." ng-focus="true" ng-keyup="findvehicleusage(search)"/>
             <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>-->                 
          </div>      
        </div> 

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
  	            <td>{{c.description}}</td>
                <td align="left">
                  <button ng-click="courseactive('',c)" class="btn btn-default" ng-if="c.active_flag==0">
                    <i class="fa fa-cloud-upload" style="color:#337AB7"></i> Activate
                  </button>
                  <button ng-click="delcourse('',c)" class="btn btn-default" ng-if="c.active_flag==1">
                    <i class="fa fa-cloud-download" style="color:red;"></i> Deactivate
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

      <!--tab pane 2-->
      <div class="tab-pane fade active in" ng-show="active==2">      
        <!-- class schedule history content -->
        <!--<div class="row">     
          <div class="input-group col-xs-12 col-md-4" style="margin: 0px 0px 0px 17px; float: left;">
             <span class="input-group-btn"> 
                <button ng-click="openmtdialog('md')" class="btn btn-default"><i class="fa fa-plus i-add"></i> <b>Add Maintenance</b></button>   
             </span>
             <input name="rsearch" class="form-control" id="rsearch" ng-model="search.$" placeholder="Search..." ng-focus="true" ng-keyup="findvehicleusage(search)"/>
             <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>                 
          </div>      
        </div>-->

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


      <!--tab pane 3-->
      <div class="tab-pane fade active in" ng-show="active==3">  
        <!-- student content -->
        <div class="row">     
          <div class="input-group col-xs-12 col-md-8 pull-left" style="margin-left:17px;">
             <span class="input-group-btn"> 
                <button ng-click="openstudentdialog()" class="btn btn-default"><i class="fa fa-plus-square-o i-add"></i> <b>Add Student</b></button>   
                <button ng-click="assignstudialog()" class="btn btn-default"><i class="fa fa-plus-square i-add"></i> <b>Assign Student</b></button> 
             </span>
             <input name="rsearch" class="form-control" id="rsearch" ng-model="search.$" placeholder="Search..." ng-focus="true" ng-keyup="findstudent(search)"/>
             <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>                 
          </div>      
        </div>

        <div style="float:right;width:170px;" ng-show="stupagi">Count : {{filteredStudent.length}} | Total : {{studnetlst.length}}</div>
        <br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="searchObjResults">
            <thead>
              <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>NRC No</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Location</th>   
                <!-- <th width="90">Option</th> -->
              </tr>
            </thead>
            <tbody>   
              <tr ng-repeat="s in filteredStudent | filter:search:strict">             
                <td>
                  <a href="student/{{s.student_id}}">{{s.name}}</a>
                </td>
                <td>
                  {{s.date_of_birth | datetimeformat}}
                </td>
                <td>{{s.nrc_no}}</td>
                <td>{{s.contact}}</td>
                <td>{{s.address}}</td>
                <td>{{s.location}}</td>
                <!-- <td>
                  <button ng-click="viewdetaildialog('',s)" class="btn btn-default btn-sm"><i class="fa fa-info-circle i-add" ></i> <b>Detail</b></button> 
                </td>  -->          
              </tr> 
            </tbody>  
          </table>
        </div>    

        <div align="right" ng-if="stupagi==true">
            <pagination boundary-links="true" total-items="totalitems" ng-model="stucurrentPage" max-size="maxSize"
               ng-change="stupageChanged()" class="pagination" 
               previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
            </pagination>   
        </div>
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
                           <select class="form-control" name="loc" ng-model="locationOne"  ng-options="l.location_desc for l in location" ></select>                                                                        
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
                  <div class="form-group col-md-12" ng-class="{'has-error': classForm.actstatus.$invalid}">
                      <label class="control-label col-md-5" for="actstatus">Active:</label>
                      <div class="controls col-md-1">
                          <input type="checkbox" style="cursor:pointer;" class="form-control" name="actstatus" ng-model="actstatus"/>                        
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

    <?php
      include "course_add_tlp.php";
      include "schedule_detail_tlp.php";
      include "student_add_tlp.php";
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
                  <!--<div class="col-md-12 alert alert-danger" role="alert" ng-if="selstuerror==true">
                    <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                      Main teacher already assign in this time!
                  </div>-->

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.studentsel.$invalid}">
                    <label class="control-label col-md-5" for="class">Select Student:</label>
                    <div class="controls col-md-5">
                        <!--<select name="studentsel" class="form-control" ng-model="studentsel" ng-options="tl.name for tl in teacherlst" required></select> -->

                        <input type='text' ng-model='studentsel' ng-focus="true" typeahead='tl as tl.name for tl in getstudentList($viewValue) | filter:$viewValue | limitTo:10' typeahead-on-select='seledstudent(studentsel)' typeahead-template-url='studentTemplate.html' class='form-control' required>                       
                    </div>

                  </div>
                
                </fieldset>
            </form>
        </div>

         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="saveassignstudent()" ng-disabled="dataForm.$invalid || selstuerror==true" class="btn btn-default"><i class="fa fa-check i-save"></i> Assign</button>       
        </div>
    </script>
    <!-- End of Assign Dialog -->

    <script type="text/ng-template" id="studentTemplate.html">
      <a href="">
        <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
        <!--<i>{{match.model.name}}</i>-->
        <!--<button type="button" ng-if="match.model.new" class="btn btn-xs btn-default pull-right"><span class="fa fa-plus-circle i-add" aria-hidden="true"></span></button>-->
      </a>
    </script>

</div>