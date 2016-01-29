    <!--Course delete confirm box-->
      <script type="text/ng-template" id="coursedelContent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" ng-click="cancel()">&times;</button>
          <h4 class="modal-title">{{title}}</h4>
        </div>
        <div class="modal-body">
            Are you sure you want to {{actiontext}}?
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="ok()">Yes</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="cancel()">No</button>
        </div>
      </script>
      <!-- End of Course delete confirm box -->