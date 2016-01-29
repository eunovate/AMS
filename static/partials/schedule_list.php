<div class="container-fluid card" ng-controller="schedule_list">

   <title>Schedule List</title>
   

   <div class="header row">
      <i class="fa fa-calendar-o"></i> Schedule List
      <div class="col-md-2 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
              <a class="btn btn-default" ng-click="addscheduoledialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Schedule</a>   
          </span>
          <!-- <span class="col-md-4">{{todaydate | date}}</span>
          <span class="col-md-2">
            <a href="#" ng-click="minusdate()"><span class="fa fa-arrow-left"></span></a>
            <a href="#" ng-click="plusdate()"><span class="fa fa-arrow-right"></span></a>
          </span> -->
          <!-- <span class="col-md-6">  -->
            <!-- <select class="form-control" name="datevale" ng-model="datevale" ng-options="d.name for d in datetypesel" ></select> -->
          <!-- </span> -->
          

        </div>

        <!-- <div class="clearfix"></div>
        <div class="row" style="margin-left:30%;">
          <span>{{todaydate | date}}</span>
          <span>
            <a href="#" ng-click="minusdate()"><span class="fa fa-arrow-left"></span></a>
            <a href="#" ng-click="plusdate()"><span class="fa fa-arrow-right"></span></a>
          </span>
        </div> -->
        

      </div>
    </div>

    <!-- date filter block-->
    <div class="row date_filter_block bg-info">
      <div class="col-md-5 col-md-offset-2">
        <span class="col-md-8 " style="margin-top:6px;" ng-if="datesearchblk==true">{{todaydate | date:'MMM dd yyyy (EEEE)'}}</span>
        <span class="col-md-8 " style="margin-top:6px;" ng-if="weeksearchblk==true">{{wmno}} - {{startday | datesearchformat}} - {{endday | datesearchformat}}</span>

        <span class="col-md-8 " style="margin-top:6px;" ng-if="monthsearchblk==true">{{wmno}} - {{endday}}</span>
        <!-- 
        <span class="col-md-6" > 
          <select class="form-control" name="datevale" ng-model="datevale" ng-options="d.name for d in datetypesel" ></select>
        </span> -->
      </div>
      <div class="col-md-5 pull-right">
          <div class="col-md-12 input-group">
            <span class="input-group-btn" ng-if="weeksearchblk == false && monthsearchblk == false">
              <button type="button" class="btn btn-default" ng-click="minusdate()"><span class="fa fa-caret-left"></span></button>
              <button type="button" class="btn btn-default" ng-click="plusdate()"><span class="fa fa-caret-right"></span></button>
            </span>
            
            <select class="form-control" name="datevale" ng-model="datevale" ng-options="d.name for d in datetypesel" ng-change="dateselsrh()"></select>
          </div>
      </div>
    </div>
    <div class="clearfix"></div><br/><br/>

    <!-- <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredClass.length}} | Total : {{class.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div> -->

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="searchObjResults">
        <thead>
          <tr>
            <th>H Teacher</th>
            <th>Date</th>   
            <th>Class</th>   
            <th>Course / Lesson</th>
            <th>Bus</th>
            <th width="270">Option</th>
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="s in schedulelst | filter:search:strict" ng-click="classlink(c.class_id)" style="cursor:pointer;">
            <td>{{s.name}}</td>
            <td>
              {{s.schedule_date | datetimeformat}} <br/>
              {{s.start_time | timeformat}} - {{s.end_time | timeformat}}
            </td>
            <td>{{s.class_name}}</td>
            <td>{{s.coursename}} / {{s.lessname}}</td>
            <td>{{s.vehiclename}}</td>
            <td>
              <button ng-click="viewdetaildialog('',s)" class="btn btn-default btn-sm"><i class="fa fa-info-circle i-add" ></i> <b>Detail</b></button> 
              <button ng-click="editscheduoledialog('',s)" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button> 
              <button ng-click="addtadialog('',s)" class="btn btn-default btn-sm"><i class="fa fa-check-square-o" style="color:#FF6C00;" ></i> <b>Assign</b></button> 
            </td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <!-- <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredClass.length}} | Total : {{class.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div> -->

    <?php
      // include "bus_add_tlp.php";
    ?>


    <!-- Add Schedule Dialog -->
    <script type="text/ng-template" id="scheduledialog">
        <div class="modal-header">
            <a class="close" ng-click="closecoursedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-calendar-o"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset> 
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.classsel.$invalid}">
                    <label class="control-label col-md-5" for="class">Class:</label>
                    <div class="controls col-md-5">
                        <select name="classsel" class="form-control" ng-model="classsel" ng-options="c.class_name for c in classlst" ng-change="classselchange()" required></select>                        
                    </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.coursesel.$invalid}">
                    <label for="course" class="control-label col-md-5">Course:</label>
                      <div class="controls col-md-5">
                        <select name="coursesel" class="form-control" ng-model="coursesel" ng-options="cl.description for cl in formatcourselst" ng-change="courseselchange()" required></select>                        
                      </div>
                  </div> 

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.lessonsel.$invalid}">
                      <label class="control-label col-md-5" for="lesson">Lesson:</label>
                      <div class="controls col-md-5">
                          <select name="lessonsel" class="form-control" ng-model="lessonsel" ng-options="ll.description for ll in formatlessonlst" required></select>                        
                      </div>
                  </div>   
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.scheduledate.$invalid}">
                      <label class="control-label col-md-5" for="scheduledate">Schedule Date:</label>
                      <div class="controls col-md-5">
                          <input type="date" class="form-control" name="scheduledate" ng-model="scheduledate" ng-keyup="formenter($event)" required/> 
                          <p class="help-block">eg : MM/DD/YYYY</p>                       
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.stime.$invalid}">
                      <label class="control-label col-md-5" for="stime">Start Time:</label>
                      <div class="controls col-md-5">
                          <input type="time" class="form-control" name="stime" ng-model="stime" placeholder="HH:mm:ss" required/>                        
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.etime.$invalid}">
                      <label class="control-label col-md-5" for="etime">End Time:</label>
                      <div class="controls col-md-5">
                          <input type="time" class="form-control" name="etime" ng-model="etime" required/>                        
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.vehiclesel.$invalid}">
                      <label class="control-label col-md-5" for="vehiclesel">Vehicle:</label>
                      <div class="controls col-md-5">
                          <select name="vehiclesel" class="form-control" ng-model="vehiclesel" ng-options="vl.v_no for vl in vehiclelst" required></select>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.driversel.$invalid}">
                    <label for="driversel" class="control-label col-md-5">Driver:</label>
                      <div class="controls col-md-5">
                        <select name="driversel" class="form-control" ng-model="driversel" ng-options="dl.name for dl in driverlst" required></select>                        
                      </div>
                  </div>
                  
                  
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.caddress.$invalid}">
                      <label class="control-label col-md-5" for="caddress">Contact Address:</label>
                      <div class="controls col-md-5">
                        <textarea class="form-control" name="caddress" ng-model="caddress"></textarea>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.cphone.$invalid}">
                      <label class="control-label col-md-5" for="cphone">Contact Phone:</label>
                      <div class="controls col-md-5">
                        <input type="text" class="form-control" name="cphone" ng-model="cphone" ng-keyup="formenter($event)"/>
                      </div>
                  </div>

                  
                </fieldset>
            </form>
        </div>

         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closecoursedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="saveschedule()" ng-disabled="dataForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Schedule Dialog -->


    <!-- Add Assign Dialog -->
    <script type="text/ng-template" id="assigndialog">
        <div class="modal-header">
            <a class="close" ng-click="closecoursedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-check-square-o"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset> 
                  <div class="col-md-12 alert alert-danger" role="alert" ng-if="assignerr==true">
                    <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                      Main teacher already assign in this time!
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.mteachersel.$invalid}">
                    <label class="control-label col-md-5" for="class">Main Teacher:</label>
                    <div class="controls col-md-5">
                        <!--<select name="mteachersel" class="form-control" ng-model="mteachersel" ng-options="tl.name for tl in teacherlst" required></select> -->

                        <input type='text' ng-model='mteachersel' ng-focus="true" typeahead='tl as tl.name for tl in getteacherList($viewValue) | filter:$viewValue | limitTo:10' typeahead-on-select='checkmttime(mteachersel)' typeahead-template-url='teacherTemplate.html' class='form-control' required>                       
                    </div>

                  </div>

                  <div class="form-group col-md-12" ng-show="tablk">
                    <label class="control-label col-md-5" for="class">TA Lists:</label>
                    <div class="controls col-md-5">
                        
                        <ul class="list-group">
                          <li class="list-group-item" ng-repeat="ta in talsts">{{ta.name}} 
                            <button type="button" class="btn btn-default btn-sm pull-right" style="margin-top:-4px;" ng-click="delta(ta.user_id)"><span class="fa fa-minus" style="color:red;"></span></button>
                          </li>
                        </ul>                       
                    </div>

                  </div>


                  <div class="form-group col-md-12">
                    <label class="control-label col-md-5" for="class">TA Assign:</label>
                    <div class="controls col-md-5">
                      <a class="btn btn-default btn-sm" ng-click="addta()"><i class="fa fa-plus"></i> </a>                      
                    </div>
                  </div>
                  <div class="clearfix"></div><br/>
                  

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.tateachersel.$invalid}" ng-repeat="tl in taassignlst">
                      <label for="tateachersel" class="control-label col-md-5">TA:</label>
                      <div class="controls col-md-5 input-group"> 

                        <input type='text' ng-model='tateachersel' x-ng-focus='descFocus' typeahead='ta as ta.name for ta in getteacherList($viewValue) | filter:$viewValue | limitTo:10' typeahead-on-select='selteacher($index,tateachersel)' typeahead-template-url='teacherTemplate.html' class='form-control' required ><!---->
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-default" ng-click="removetarow($index)"><span class="fa fa-minus" style="color:red;"></span></button>
                        </span>
                      </div>
                  </div> 
                  
                </fieldset>
            </form>
        </div>

         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closecoursedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="saveassignteacher()" ng-disabled="dataForm.$invalid || assignerr==true" class="btn btn-default"><i class="fa fa-check i-save"></i> Assign</button>       
        </div>
    </script>
    <!-- End of Assign Dialog -->

    <script type="text/ng-template" id="teacherTemplate.html">
      <a href="">
        <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
        <!--<i>{{match.model.name}}</i>-->
        <!--<button type="button" ng-if="match.model.new" class="btn btn-xs btn-default pull-right"><span class="fa fa-plus-circle i-add" aria-hidden="true"></span></button>-->
      </a>
    </script>

    <?php
      include "schedule_detail_tlp.php";
    ?>

</div>