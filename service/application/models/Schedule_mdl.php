<?php
	class Schedule_mdl extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		// get all schedule list
		function get_schedule_lst($data)
		{
			$srhdate = $this->db->escape_like_str($data->srhdate);
			$srhpara = $this->db->escape_like_str($data->srhpara);
			// $this->db->select('s.*,u.name,c.class_name,l.description as lessname,v.description as vehiclename, co.description as coursename,co.course_id');
			// $this->db->from('schedule s');
			// $this->db->join('schedule_person sp', 'sp.schedule_id = s.schedule_id', 'left');
			// $this->db->join('user u', 'u.user_id = s.head_teacher_id', 'left');
			// $this->db->join('class c', 'c.class_id = s.class_id', 'left');
			// $this->db->join('lesson l', 'l.lesson_id = s.lesson_id', 'left');
			// $this->db->join('course co', 'l.course_id = co.course_id', 'left');
			// $this->db->join('vehicle v', 'v.vehicle_id = s.vehicle_id', 'left');
			// if($srhpara==2){
			// 	$array = array('week(s.schedule_date)' => week($srhdate));
			// }else if($srhpara==3){
			// 	$array = array('month(s.schedule_date)' => month($srhdate));
			// }else{
			// 	$array = array('s.schedule_date' => $srhdate);
			// }
			
			// $this->db->where($array);
			// $this->db->group_by('s.schedule_id');
			// $query = $this->db->get();

			$selectsql = "select s.*,u.name,c.class_name,l.description as lessname,v.v_no as vehiclename, co.description as coursename,co.course_id 
							from schedule as s 
							left join schedule_person as sp on sp.schedule_id = s.schedule_id 
							left join user as u on u.user_id = s.head_teacher_id 
							left join class as c on c.class_id = s.class_id 
							left join lesson as l on l.lesson_id = s.lesson_id 
							left join course as co on l.course_id = co.course_id 
							left join vehicle as v on v.vehicle_id = s.vehicle_id";
			$selectsql .= " where";
			
			if($srhpara==2){
				$selectsql .= " week(s.schedule_date) = week(?)";
			}else if($srhpara==3){
				$selectsql .= " month(s.schedule_date) = month(?)";
			}else{
				$selectsql .= " s.schedule_date = ?";
			}
			$selectsql.=" and s.active_flag=1 group by s.schedule_id";
			// $selectsql.=" cin.base_flag=0 group by ce.exchange_id order by ce.exchange_id desc";
			$query = $this->db->query($selectsql,array($srhdate));

			return $query->result();
		}	

		// get all class list
		function get_class_lst()
		{
			$this->db->select('');
			$this->db->from('class');
			$query = $this->db->get();
			return $query->result();
		}

		// get all course list
		function get_course_lst()
		{
			$this->db->select('c.course_id,c.description,cc.class_id');
			$this->db->from('course c');
			$this->db->join('course_class cc', 'cc.course_id = c.course_id', 'left');
			$query = $this->db->get();
			return $query->result();
		}

		// get all lesson list
		function get_lesson_lst()
		{
			$this->db->select('');
			$this->db->from('lesson');
			$query = $this->db->get();
			return $query->result();
		}

		// get all vehicle list
		function get_vehicle_lst()
		{
			$this->db->select('*');
			$this->db->from('vehicle');
			$query = $this->db->get();
			return $query->result();
		}

		// get all driver list
		function get_driver_lst()
		{
			$this->db->select('u.name,u.user_id,r.description');
			$this->db->from('user u');
			$this->db->join('user_group ug', 'ug.user_gp_id = u.user_gp_id', 'left');
			$this->db->join('role r', 'r.role_id = ug.role_id', 'left');
			$array = array('r.description' => 'Driver');
			$this->db->where($array);
			$query = $this->db->get();
			return $query->result();
		}

		//add schedule data
		function add_schedule_data($data){
			//add schedule data
			$scheduledata=array(
						"class_id"=>$this->db->escape_like_str($data->classid),
						"lesson_id"=>$this->db->escape_like_str($data->lessonid),
					 	"driver_id"=>$this->db->escape_like_str($data->driverid),
					   	"schedule_date"=>$this->db->escape_like_str($data->scheduledate),
					   	"start_time"=>$this->db->escape_like_str($data->starttime),
					   	"end_time"=>$this->db->escape_like_str($data->endtime),
					   	"vehicle_id"=>$this->db->escape_like_str($data->vechicleid),
					   	"contact_address"=>$this->db->escape_like_str($data->caddress),
					   	"contact_phone"=>$this->db->escape_like_str($data->cphone),
					   	"created_user_id"=>$this->db->escape_like_str($data->cuserid),
					   	"active_flag" => 1
					);
			return $this->db->insert("schedule",$scheduledata);
		}

		//update schedule data
		function update_schedule_data($data)
		{
			$id = $this->db->escape_like_str($data->scheduleid);
			$scheduledata=array(
						"class_id"=>$this->db->escape_like_str($data->classid),
						"lesson_id"=>$this->db->escape_like_str($data->lessonid),
					 	"driver_id"=>$this->db->escape_like_str($data->driverid),
					   	"schedule_date"=>$this->db->escape_like_str($data->scheduledate),
					   	"start_time"=>$this->db->escape_like_str($data->starttime),
					   	"end_time"=>$this->db->escape_like_str($data->endtime),
					   	"vehicle_id"=>$this->db->escape_like_str($data->vechicleid),
					   	"contact_address"=>$this->db->escape_like_str($data->caddress),
					   	"contact_phone"=>$this->db->escape_like_str($data->cphone)
					);
			$this->db->where('schedule_id',$id);
			return $this->db->update('schedule',$scheduledata);
		}

		// get all teacher list
		function get_teacher_lst()
		{
			$this->db->select('u.name,u.user_id,r.description');
			$this->db->from('user u');
			$this->db->join('user_group ug', 'ug.user_gp_id = u.user_gp_id', 'left');
			$this->db->join('role r', 'r.role_id = ug.role_id', 'left');
			$array = array('r.description' => 'Teacher');
			$this->db->where($array);
			$query = $this->db->get();
			return $query->result();
		}

		//check main teacher assign
		function check_mteacher_assign($data){
			$userid = $this->db->escape_like_str($data->userid);
			$scheduleid = $this->db->escape_like_str($data->scheduleid);
			$scheduledate = $this->db->escape_like_str($data->scheduledate);
			$starttime = $this->db->escape_like_str($data->starttime);
			$endtime = $this->db->escape_like_str($data->endtime);

		  	$sql="SELECT *
					FROM schedule  
					where  head_teacher_id=? and schedule_date=? and (hour(start_time) between hour(?) and hour(?))";
			$row=$this->db->query($sql,array($userid,$scheduledate,$starttime,$starttime));

		  	if($row->num_rows() == 1)
		   	{
		     	return true;
		   	}
		   	else{
		   		return false;
		   	}
		}

		//add assign teacher on schedule person
		function add_assign_teachers($data){
			$scheduleid = $this->db->escape_like_str($data->scheduleid);
			$scheduledata=array(
						"head_teacher_id"=>$this->db->escape_like_str($data->mainteacherid)
					);
			$this->db->where('schedule_id',$scheduleid);
			if($this->db->update('schedule',$scheduledata)){
				if($data->talst){
					foreach($data->talst as $talsts){
						$tadata=array(
							"schedule_id"=>$scheduleid,
							"user_id"=>$this->db->escape_like_str($talsts->user_id)
						);
						$this->db->insert("schedule_person",$tadata);
					}
				}
				return true;
				
			}else{
				return false;
			}
			
		}

		// get ta list for this schedule
		function get_ta_lst($data)
		{
			$scheduleid = $this->db->escape_like_str($data->scheduleid);
			$this->db->select('u.name,u.user_id');
			$this->db->from('schedule_person sp');
			$this->db->join('user u', 'sp.user_id = u.user_id', 'left');
			$array = array('sp.schedule_id' => $scheduleid);
			$this->db->where($array);
			$query = $this->db->get();
			return $query->result();
		}

		//get driver info 
		function get_driver_info($data){
			$scheduleid = $this->db->escape_like_str($data->scheduleid);
			$this->db->select('u.name as drivername,u.user_id');
			$this->db->from('schedule s');
			$this->db->join('user u', 's.driver_id = u.user_id', 'left');
			$array = array('s.schedule_id' => $scheduleid);
			$this->db->where($array);
			$query = $this->db->get();
			return $query->result();
		}

		//del ta data from this schedule
		function del_ta_data($data){
			$scheduleid = $this->db->escape_like_str($data->scheduleid);
			$userid = $this->db->escape_like_str($data->userid);
			$this->db->where('schedule_id',$scheduleid);
			$this->db->where('user_id',$userid);
  			return $this->db->delete('schedule_person');
		}

		

		//get behaviour rating list
		function behaviour_rating_lst($data){
			$chkscheduleid = $this->db->escape_like_str($data->scheduleid);
			// $srhpara = $this->db->escape_like_str($data->srhpara);

			$selectsql = "select b.behaviour_id,b.description,sum(br.rating) as totalrate
							from attendance as a
							left join behaviour_record as br on a.attendance_id = br.attendance_id  
							left join behaviour as b on b.behaviour_id = br.behaviour_id 
							where a.schedule_id=? group by b.behaviour_id";
			$query = $this->db->query($selectsql,array($chkscheduleid));

			return $query->result();
		}

		//get attendance count data
		function attend_count_data($data){
			$chkscheduleid = $this->db->escape_like_str($data->scheduleid);
			$selectsql = "select schedule_id, count(student_id) as totalcount, 
							(Select Count(*) from attendance where schedule_id=? and present_flag=?) as presentcount  
							from attendance 
							where schedule_id=?";
			$query = $this->db->query($selectsql,array($chkscheduleid,1,$chkscheduleid));

			return $query->result();
		}

		//get student rating list
		function student_behaviour_rating_data($data){
			$chkscheduleid = $this->db->escape_like_str($data->scheduleid);
			// $chkbehaviour = $this->db->escape_like_str($data->behaviourid);

			$selectsql = "select s.name as stuname,br.*,a.student_id
							from attendance as a
							left join behaviour_record as br on a.attendance_id = br.attendance_id  
							left join student as s on s.student_id = a.student_id 
							where a.schedule_id=? and a.present_flag=? group by a.student_id,br.behaviour_id";
			$query = $this->db->query($selectsql,array($chkscheduleid,1));

			return $query->result();
		}

		//get student absent data
		function get_stu_absent_data($data){
			$chkscheduleid = $this->db->escape_like_str($data->scheduleid);

			$selectsql = "select a.*, s.name as stuname
							from attendance as a 
							left join student as s on s.student_id = a.student_id 
							where a.schedule_id=? and a.present_flag=?";
			$query = $this->db->query($selectsql,array($chkscheduleid,0));

			return $query->result();
		}

	}

?>