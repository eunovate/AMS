<?php
class Course_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getcourselist(){
		$this->db->select("*");
		$this->db->from("course");
		$this->db->order_by("course_id","desc");
		$q=$this->db->get();

		return $q->result();
	}

	public function savecourse($data){
		$d=array("description"=>$data->name);

		$this->db->insert("course",$d);
		return true;
	}

	public function updatecourse($data){
		$d=array("description"=>$data->name);

		$this->db->update("course",$d,array("course_id"=>$data->course_id));
		return true;
	}

	function add_course_data($data)
	{
		$classid = $this->db->escape_like_str($data->classid);
		$coursedata=array(
					"description"=>$this->db->escape_like_str($data->coursename)
				);

		if($this->db->insert("course",$coursedata)){
			$courseid = $this->db->insert_id();
			$classcoursedata=array(
					"class_id"=>$classid,
					"course_id"=>$courseid
				);
			return $this->db->insert("course_class",$classcoursedata);
		}
	}

	//get course data
	function get_course_data($courseid){
		$chkcourseid = $this->db->escape_like_str($courseid);
		$this->db->select("*");
		$this->db->from("course");
		$array = array('course_id' => $chkcourseid);
		$this->db->where($array);
		$q=$this->db->get();

		return $q->result();
	}

	// get all course schedule list
	function get_course_schedule_lst($data)
	{
		$chkcourseid = $this->db->escape_like_str($data->courseid);
		
		$selectsql = "select s.*,u.name,c.class_name,l.description as lessname,v.v_no as vehiclename, co.description as coursename,co.course_id 
						from schedule as s 
						left join schedule_person as sp on sp.schedule_id = s.schedule_id 
						left join user as u on u.user_id = s.head_teacher_id 
						left join class as c on c.class_id = s.class_id 
						left join lesson as l on l.lesson_id = s.lesson_id 
						left join course as co on l.course_id = co.course_id 
						left join vehicle as v on v.vehicle_id = s.vehicle_id";
		$selectsql .= " where";
		
		
		$selectsql.=" co.course_id =? and s.active_flag=1 group by s.schedule_id";
		
		$query = $this->db->query($selectsql,array($chkcourseid));

		return $query->result();
	}
}
?>