<link href="./static/css/vehicle.css" rel="stylesheet"/>
<div class="container-fluid card" ng-controller="course_dtl">
	<title>Course Details</title>
    <div class="header row">
   		<i class="fa fa-book"></i> Course Details 
 	</div>

	<div style="margin: 7px 0px 15px 0px;" align="left">
  		<a href="javascript:history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> <b>Back</b></a>
  		<button ng-click="opencourseeditdialog(c,'md')" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button>	
  	</div>

  	 <div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-hover" style="background-color:white">
				<tr>
					<td style="width:15%">Description :</td>
        	<td style="text-align:left;">{{coursedata.description}}</td>
				</tr>			
			</table>
		</div>
	</div>

	<!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
        <a href="" role="tab" data-toggle="tab" ng-click="showschedulelst()">
          <i class="fa fa-calendar-o"></i>  Schedule
        </a>
      </li>    
    </ul>

   <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" ng-show="active==1">
      
      <!-- schedule content -->
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

    </div>

    <?php
      include "course_add_tlp.php";
      include "schedule_detail_tlp.php";
    ?>
      

              
</div>