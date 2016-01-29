<div class="container-fluid card" ng-controller="lesson_list">

   <title>Lesson List</title>
   <div class="header row">
      <i class="fa fa-book"></i> Lesson List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
             	<a class="btn btn-default" ng-click="openlessondialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Lesson</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="findlesson(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredLessons.length}} | Total : {{lessons.length}}
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
            <th>Course</th>   
            <th>Lesson</th>
         	  <th width="5%"style="text-align:right">&nbsp;</th>   
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="l in filteredLessons | filter:search:strict">
            <td ng-show="filteredLessons[$index].course_id==filteredLessons[$index-1].course_id">&nbsp;</td>
            <td ng-show="filteredLessons[$index].course_id!=filteredLessons[$index-1].course_id">{{l.course}}</td>
            <td>{{l.description}}</td>
            <td>
            	<a class="btn btn-default" ng-click="openlessoneditdialog(l,'md')">
              <i class="fa fa-edit i-edit"></i> Edit</a> 
            </td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredLessons.length}} | Total : {{lessons.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <!-- Lesson Dialog -->
    <script type="text/ng-template" id="lessondialog">
        <div class="modal-header">
            <a class="close" ng-click="closelessondialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-book"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="lessonForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': lessonForm.cu.$invalid}">
                      <label class="control-label col-md-5" for="cu">Course:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="cu" ng-model="courseOne" ng-options="c.description for c in course" ></select>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': lessonForm.les.$invalid}">
                      <label class="control-label col-md-5" for="les">Lesson:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="les" ng-focus="true" ng-model="lesson.name" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closelessondialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savelesson()" ng-disabled="lessonForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of Lesson Dialog -->

</div>