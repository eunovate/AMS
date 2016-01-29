<?php
class Vehicle_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getvehiclelist(){
		$this->db->select("*");
		$this->db->from("vehicle");
		$this->db->order_by("vehicle_id","desc");
		$q=$this->db->get();

		return $q->result();
	}

	public function savevehicle($data){
		$d=array(
				 "v_no"=>$this->db->escape_like_str($data->vno),
				 "v_brand"=>$this->db->escape_like_str($data->brand),
				 "v_chassic"=>$this->db->escape_like_str($data->chassic),
				 "v_engine"=>$this->db->escape_like_str($data->engine),
				 "v_model"=>$this->db->escape_like_str($data->model),
				 "v_color"=>$this->db->escape_like_str($data->color),
				 "licence_expired_date"=>$this->db->escape_like_str($data->vledate),
				 "bought_date"=>$this->db->escape_like_str($data->bdate)
				);

		return $this->db->insert("vehicle",$d);
	}

	public function updatevehicle($data){
		$chkvid = $this->db->escape_like_str($data->vid);
		$d=array(
				 "v_no"=>$this->db->escape_like_str($data->vno),
				 "v_brand"=>$this->db->escape_like_str($data->brand),
				 "v_chassic"=>$this->db->escape_like_str($data->chassic),
				 "v_engine"=>$this->db->escape_like_str($data->engine),
				 "v_model"=>$this->db->escape_like_str($data->model),
				 "v_color"=>$this->db->escape_like_str($data->color),
				 "licence_expired_date"=>$this->db->escape_like_str($data->vledate),
				 "bought_date"=>$this->db->escape_like_str($data->bdate)
				);

		return $this->db->update("vehicle",$d,array("vehicle_id"=>$chkvid));
	}

	public function getvehicledtl($id){
		$this->db->select("*");
		$this->db->from("vehicle");
		$this->db->where(array("vehicle_id"=>$id));
		$this->db->order_by("vehicle_id","desc");
		$q=$this->db->get();

		return $q->row();
	}


	public function getvehicleusage($vehicleid){
		$chkvehicleid = $this->db->escape_like_str($vehicleid);
		
		$selectsql = "select vu.*, u.name as createduser  
						from vehicle_usage as vu 
						left join vehicle_usage_line as vul on vu.vehicle_usage_id=vul.vehicle_usage_id 
						left join user as u on u.user_id = vu.user_id 
						where vu.vehicle_id =?  group by vu.vehicle_usage_id order by vu.vehicle_usage_id desc";
		
		$query = $this->db->query($selectsql,array($chkvehicleid));

		return $query->result();
	}

	//add vehicle usage
	// public function savevehicleusage($data){
	// 	$checkodom = $this->db->escape_like_str($data->endodom);
	// 	if($checkodom!=0){
	// 		$endodom = date("Y-m-d H:i:s");
	// 	}else{
	// 		$endodom = 0;
	// 	}
	// 	$d=array(
	// 			"vehicle_id"=>$this->db->escape_like_str($data->vehicleid),
	// 			 "start_odometer"=>$this->db->escape_like_str($data->startodom),
	// 			 "started_time"=>date("Y-m-d H:i:s"),
	// 			 "end_odometer"=>$checkodom,
	// 			 "ended_time"=>$endodom,
	// 		     "user_id"=>$this->db->escape_like_str($data->userid)
	// 		    );

	// 	if($this->db->insert("vehicle_usage",$d)){
	// 		$vusageid = $this->db->insert_id();
	// 		if($data->loclst){
	// 			foreach($data->loclst as $loclsts){
	// 				$locdata=array(
	// 					"vehicle_usage_id"=>$vusageid,
	// 					"location_id"=>$this->db->escape_like_str($loclsts->location_id),
	// 					"added_time"=>date("Y-m-d H:i:s"),
	// 					"active_flag"=>1
	// 				);
	// 				$this->db->insert("vehicle_usage_line",$locdata);
	// 			}
	// 		}
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }


	//update vehicle usage
	// public function update_vehicle_usage($data){
	// 	$checkodom = $this->db->escape_like_str($data->endodom);
	// 	$vusageid = $this->db->escape_like_str($data->vuid);

	// 	if($checkodom!=0){
	// 		$endodom = date("Y-m-d H:i:s");
	// 	}else{
	// 		$endodom = 0;
	// 	}
	// 	$d=array(
	// 			"vehicle_id"=>$this->db->escape_like_str($data->vehicleid),
	// 			 "start_odometer"=>$this->db->escape_like_str($data->startodom),
	// 			 "end_odometer"=>$checkodom,
	// 			 "ended_time"=>$endodom,
	// 		     "user_id"=>$this->db->escape_like_str($data->userid)
	// 		    );
	// 	$this->db->where('vehicle_usage_id',$vusageid);
	// 	if($this->db->update('vehicle_usage',$d)){
	// 		if($data->loclst){
	// 			foreach($data->loclst as $loclsts){
	// 				$locdata=array(
	// 					"vehicle_usage_id"=>$vusageid,
	// 					"location_id"=>$this->db->escape_like_str($loclsts->location_id),
	// 					"added_time"=>date("Y-m-d H:i:s")
	// 				);
	// 				$this->db->insert("vehicle_usage_line",$locdata);
	// 			}
	// 		}
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }

	/*Vehicle Maintenance*/
	public function getmaintenance($id){
		$q=$this->db->query("SELECT vm.*,u.user_name
							 FROM vehicle_maintenance as vm 
							 LEFT JOIN user as u ON(vm.user_id=u.user_id)");
		return $q->result();
	}

	public function savemaintenance($data){
		$d=array("vehicle_id"=>$data->vehicleid,
				 "oil"=>$data->oil,
				 "coolant"=>$data->coolant,
				 "air"=>$data->air,
				 "comment"=>$data->comment,
			     "user_id"=>$data->userid);

		$this->db->insert("vehicle_maintenance",$d);
		return true;
	}

	// get all vehicle schedule list
	function get_vehicle_schedule_lst($data)
	{
		$chkvehicleid = $this->db->escape_like_str($data->vehicleid);
		
		$selectsql = "select s.*,u.name,c.class_name,l.description as lessname,v.v_no as vehiclename, co.description as coursename,co.course_id 
						from schedule as s 
						left join schedule_person as sp on sp.schedule_id = s.schedule_id 
						left join user as u on u.user_id = s.head_teacher_id 
						left join class as c on c.class_id = s.class_id 
						left join lesson as l on l.lesson_id = s.lesson_id 
						left join course as co on l.course_id = co.course_id 
						left join vehicle as v on v.vehicle_id = s.vehicle_id";
		$selectsql .= " where";
		
		
		$selectsql.=" s.vehicle_id =? and s.active_flag=1 group by s.schedule_id";
		
		$query = $this->db->query($selectsql,array($chkvehicleid));

		return $query->result();
	}

	//get vehicle usage location list
	function get_vu_location_lst($data){
		$chkvuid = $this->db->escape_like_str($data->vuid);
		
		$selectsql = "select vul.*,l.location_desc
						from vehicle_usage_line as vul 
						left join location as l on l.location_id = vul.location_id 
						where vul.vehicle_usage_id =? and active_flag=1";
		$query = $this->db->query($selectsql,array($chkvuid));

		return $query->result();
	}

	//add start odometer
	function add_start_odometer($data){
		$d=array(
				"vehicle_id"=>$this->db->escape_like_str($data->vehicleid),
				 "start_odometer"=>$this->db->escape_like_str($data->startodom),
				 "started_time"=>date("Y-m-d H:i:s"),
				 "end_odometer"=>0,
			     "user_id"=>$this->db->escape_like_str($data->userid)
			    );

		$this->db->insert("vehicle_usage",$d);
		return $this->db->insert_id();
	}

	//update start odometer
	function update_start_odometer($data){
		$vusageid = $this->db->escape_like_str($data->vuid);
		$d=array(
				 "start_odometer"=>$this->db->escape_like_str($data->startodom)
			    );

		$this->db->where('vehicle_usage_id',$vusageid);
		return $this->db->update('vehicle_usage',$d);
	}


	//add start odometer
	function add_vu_location($data){
		$vusageid = $this->db->escape_like_str($data->vuid);
		$locdata=array(
						"vehicle_usage_id"=>$vusageid,
						"location_id"=>$this->db->escape_like_str($data->locationid),
						"added_time"=>date("Y-m-d H:i:s"),
						"active_flag"=>1
					);
		return	$this->db->insert("vehicle_usage_line",$locdata);
	}

	//add end odometer
	function add_end_odometer($data){
		$vusageid = $this->db->escape_like_str($data->vuid);
		$d=array(
				 "end_odometer"=>$this->db->escape_like_str($data->endodometer),
				 "ended_time"=>date("Y-m-d H:i:s")
			    );

		$this->db->where('vehicle_usage_id',$vusageid);
		return $this->db->update('vehicle_usage',$d);
	}

	//update end odometer
	function update_end_odometer($data){
		$vusageid = $this->db->escape_like_str($data->vuid);
		$d=array(
				 "end_odometer"=>$this->db->escape_like_str($data->endodometer),
			    );

		$this->db->where('vehicle_usage_id',$vusageid);
		return $this->db->update('vehicle_usage',$d);
	}

	//del location data
	function del_location_data($data){
		$vusageid = $this->db->escape_like_str($data->vuid);
		$chklocid = $this->db->escape_like_str($data->locid);
		$d=array(
				 "active_flag"=>0
			    );
		$array = array('vehicle_usage_id' => $vusageid,'location_id'=>$chklocid);
		$this->db->where($array);
		return $this->db->update('vehicle_usage_line',$d);
	}

	//get vehicle usage all location list
	function get_vu_alllocation_lst($data){
		$chkvuid = $this->db->escape_like_str($data->vuid);
		
		$selectsql = "select vul.*,l.location_desc
						from vehicle_usage_line as vul 
						left join location as l on l.location_id = vul.location_id 
						where vul.vehicle_usage_id =? order by vul.added_time";
		$query = $this->db->query($selectsql,array($chkvuid));

		return $query->result();
	}

}
?>