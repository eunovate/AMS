<div class="container-fluid card" ng-controller="course_list">

   <title>Course List</title>
   <div class="header row">
      <i class="fa fa-book"></i> Course List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
             	<a class="btn btn-default" ng-click="opencoursedialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Course</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="findcourse(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredCourses.length}} | Total : {{courses.length}}
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
            <th width="95%">Course Description</th>   
         	  <!-- <th style="text-align:right">&nbsp;</th>    -->
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="c in filteredCourses | filter:search:strict" ng-click="courselink(c.course_id)" style="cursor:pointer;">
            <td>{{c.description}}</td>
            <!-- <td>
            	<a class="btn btn-default" ng-click="opencourseeditdialog(c,'md')">
              <i class="fa fa-edit i-edit"></i> Edit</a> 
            </td> -->
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredCourses.length}} | Total : {{courses.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <!-- Course Dialog -->
    <script type="text/ng-template" id="coursedialog">
        <div class="modal-header">
            <a class="close" ng-click="closecoursedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-book"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="courseForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': courseForm.cname.$invalid}">
                      <label class="control-label col-md-5" for="cname">Course Description:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="cname" ng-focus="true" ng-model="course.name" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closecoursedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savecourse()" ng-disabled="courseForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Course Dialog -->

</div>