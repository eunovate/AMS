<!-- Schedule Detail Dialog -->
    <script type="text/ng-template" id="scheduledetaildialog">
        <div class="modal-header">
            <a class="close" ng-click="closecoursedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <div class="col-md-12">
              <div class="col-md-6">
                
                Course Name : {{scheduledetail.coursename}} <br/>
                Lesson Name : {{scheduledetail.lessname}} <br/>
                Vehicle : {{scheduledetail.vehiclename}} <br/>
              </div>
              <div class="col-md-6">
                Schedule Date : {{scheduledetail.schedule_date | datetimeformat}} <br/>
                Time : {{scheduledetail.start_time | timeformat}} - {{scheduledetail.end_time | timeformat}}<br/>
              </div>
              <div class="clearfix"></div><br/>
              <div class="col-md-4">
                <ul class="list-group">
                  <li class="list-group-item"><b>Main Teacher</b></li>
                  <li class="list-group-item"><a href="teacher/{{scheduledetail.head_teacher_id}}" ng-click="closecoursedialog()">{{scheduledetail.name}}</a></li>
                </ul>
              </div>
              <div class="col-md-4">
                <li class="list-group-item"><b>TA Lists</b></li>
                <li class="list-group-item" ng-repeat="ta in talsts"><a href="teacher/{{ta.user_id}}" ng-click="closecoursedialog()">{{ta.name}}</a></li>
              </div>
              <div class="col-md-4">
                <li class="list-group-item"><b>Driver</b></li>
                <li class="list-group-item"><a href="driver/{{driverinfo.user_id}}" ng-click="closecoursedialog()">{{driverinfo.drivername}}</a></li>
              </div>
              <div class="clearfix"></div><br/>

              <div class="col-md-12">
                <p>Attendance Status : {{attenddata.presentcount}}/{{attenddata.totalcount}}</p>
              </div>
              <div class="col-md-12">
                <button class="btn btn-default pull-right" ng-click="ratingdetail('lg')"><i class="fa fa-info-circle"></i> Schedule Detail</button>      
              </div>
              <div class="clearfix"></div>

              <div ng-if="hidebstatus==false">
                <hr/>
                <div class="clearfix"></div>

                <div class="col-md-12">
                  <h4>Behaviour Status</h4>

                  <div class="table-responsive">
                    <table class="table table-striped ">
                      <tbody>   
                        <tr ng-repeat="n in behaviourslst">
                          <td>
                            {{n.description}}
                          </td>
                          <td>
                            Average Rating: {{ n.avgrate | number:1}} / 5
                            <div class="average">
                              <average-star-rating ng-model="n.avgrate" max="5"><average-star-rating>    
                            </div>
                          </td>
                        </tr> 

                      </tbody>  
                    </table>
                  </div>

                </div>

              </div>


            </div>
            <div class="clearfix"></div><br/>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closecoursedialog()"><i class="fa fa-times"></i> Cancel</button>      
        </div>

    </script>
    <!-- End of Schedule Detail Dialog -->


    <!-- Rating Detail Dialog -->
    <script type="text/ng-template" id="ratingdetaildialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <div class="col-md-12">
              
              <div class="col-md-12">
                <h4>Behaviour Status Detail</h4>

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Student Name</th>  
                        <th class="tbl_center">B1</th>
                        <th class="tbl_center">B2</th>
                        <th class="tbl_center">B3</th>
                        <th class="tbl_center">B4</th> 
                        <th class="tbl_center">B5</th>   
                      </tr>
                    </thead>
                    <tbody>   
                      <tr>
                        <td>
                          name 1
                        </td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                        <td class="tbl_center">3</td>
                      </tr> 

                      <tr>
                        <td>
                          name 2
                        </td>
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

              <div class="col-md-12"> 
                <h4>Absent Student Detail</h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Student Name</th>  
                        <th width="70%">Comment</th>  
                      </tr>
                    </thead>
                    <tbody>   
                      <tr ng-repeat="sab in stuabsentlst">
                        <td>{{sab.stuname}}</td>
                        <td>{{sab.comment}}</td>
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
    <!-- End of Rating Detail Dialog -->