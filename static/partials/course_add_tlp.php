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