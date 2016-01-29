<?php
class Staff_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// get all course schedule list
	function get_staff_schedule_lst($data)
	{
		$chkstaffid = $this->db->escape_like_str($data->staffid);
		
		$selectsql = "select s.*,u.name,c.class_name,l.description as lessname,v.v_no as vehiclename, co.description as coursename,co.course_id 
						from schedule as s 
						left join schedule_person as sp on sp.schedule_id = s.schedule_id 
						left join user as u on u.user_id = s.head_teacher_id 
						left join class as c on c.class_id = s.class_id 
						left join lesson as l on l.lesson_id = s.lesson_id 
						left join course as co on l.course_id = co.course_id 
						left join vehicle as v on v.vehicle_id = s.vehicle_id";
		$selectsql .= " where";
		
		
		$selectsql.=" (s.head_teacher_id =? or s.driver_id=?) and s.active_flag=1 group by s.schedule_id";
		
		$query = $this->db->query($selectsql,array($chkstaffid,$chkstaffid));

		return $query->result();
	}
}
?>