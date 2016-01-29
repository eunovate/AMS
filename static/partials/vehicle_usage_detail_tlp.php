<!-- Schedule Detail Dialog -->
    <script type="text/ng-template" id="vudetaildialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <div class="col-md-12">
              <div class="col-md-6">
                
                Start Odometer : {{vudetail.start_odometer}} <br/>
                Start Time : {{vudetail.started_time | datetimeformat}} <br/>
                User : {{vudetail.createduser}} <br/>
              </div>
              <div class="col-md-6">
                End Odometer : {{vudetail.end_odometer}} <br/>
                End Time : {{vudetail.ended_time | datetimeformat}}<br/>
              </div>
              <div class="clearfix"></div><br/>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Location</th> 
                        <th>Added Time</th>
                        <th></th>    
                      </tr>
                    </thead>
                    <tbody>   
                      <tr ng-repeat="v in loclsts">  
                        <td>{{v.location_desc}}</td>
                        <td>{{v.added_time | datetime}}</td> 
                        <td align="center">
                          <span ng-if="v.active_flag==1"><i class="fa fa-plus-circle i-save" ></i> </span> 
                          <span ng-if="v.active_flag==0"><i class="fa fa-minus-circle" style="color:#FF6C00;" ></i> </span>
                        </td>       
                      </tr> 
                    </tbody>  
                  </table>
                </div>

              </div>

            </div>
            <div class="clearfix"></div><br/>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>      
        </div>

    </script>
    <!-- End of Schedule Detail Dialog -->