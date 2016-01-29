<?php
class Class_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getclasslist(){
		$q=$this->db->query("SELECT c.*,b.v_no as vehicle,u.user_name,
							 l.location_desc
							 FROM class as c
							 LEFT JOIN location as l ON(c.location_id=l.location_id)
							 LEFT JOIN vehicle as b ON(b.vehicle_id=c.vehicle_id)
							 LEFT JOIN user as u ON(u.user_id=c.user_id)
							 GROUP BY c.class_id
							 ORDER BY c.class_id DESC;");

		return $q->result();
	}

	public function getclassdtl($id){
		$q=$this->db->query("SELECT c.*,b.v_no as vehicle,u.user_name,
							 l.location_desc
							 FROM class as c
							 LEFT JOIN location as l ON(c.location_id=l.location_id)
							 LEFT JOIN vehicle as b ON(b.vehicle_id=c.vehicle_id)
							 LEFT JOIN user as u ON(u.user_id=c.user_id)
							 WHERE c.class_id=$id
							 GROUP BY c.class_id
							 ORDER BY c.class_id DESC;");

		return $q->row();
	}

	public function getlocation(){
		$this->db->select("*");
		$this->db->from("location");
		$this->db->order_by("location_id","desc");
		$q=$this->db->get();

		return $q->result();
	}

	public function getclasscourse($id){
		$q=$this->db->query("SELECT c.*,cc.class_id,cc.active_flag 
							 FROM course as c
							 LEFT JOIN course_class as cc ON(c.course_id=cc.course_id)
							 WHERE cc.class_id=$id
							 GROUP BY c.course_id
							 ORDER BY c.course_id DESC;");

		return $q->result();
	}

	public function saveclass($data){
		$d=array(
				 "class_name"=>$this->db->escape_like_str($data->classname),
				 "vehicle_id"=>$this->db->escape_like_str($data->vehicleid),
				 "location_id"=>$this->db->escape_like_str($data->locationid),
				 "user_id"=>$this->db->escape_like_str($data->createduserid),
				 "active_flag"=>1
				);

		$q=$this->db->insert("class",$d);
		return true;
	}

	public function updateclass($data){
		$chkclassid = $this->db->escape_like_str($data->classid);
		$d=array(
				 "class_name"=>$this->db->escape_like_str($data->classname),
				 "vehicle_id"=>$this->db->escape_like_str($data->vehicleid),
				 "location_id"=>$this->db->escape_like_str($data->locationid),
				 "user_id"=>$this->db->escape_like_str($data->createduserid),
				 "active_flag"=>$this->db->escape_like_str($data->activestatus)
				);

		$q=$this->db->update("class",$d,array("class_id"=>$chkclassid));
		return true;
	}

	public function savelocation($data){
		$d=array(
			"location_desc"=>$this->db->escape_like_str($data->name)
			);

		$q=$this->db->insert("location",$d);
		return true;
	}

	// get all class schedule list
	function get_class_schedule_lst($data)
	{
		$chkclassid = $this->db->escape_like_str($data->classid);
		
		$selectsql = "select s.*,u.name,c.class_name,l.description as lessname,v.v_no as vehiclename, co.description as coursename,co.course_id 
						from schedule as s 
						left join schedule_person as sp on sp.schedule_id = s.schedule_id 
						left join user as u on u.user_id = s.head_teacher_id 
						left join class as c on c.class_id = s.class_id 
						left join lesson as l on l.lesson_id = s.lesson_id 
						left join course as co on l.course_id = co.course_id 
						left join vehicle as v on v.vehicle_id = s.vehicle_id";
		$selectsql .= " where";
		
		
		$selectsql.=" s.class_id =? and s.active_flag=1 group by s.schedule_id";
		
		$query = $this->db->query($selectsql,array($chkclassid));

		return $query->result();
	}

	//update course status from class
	function update_course_status($data){
		$chkclassid = $this->db->escape_like_str($data->classid);
		$chkcourseid = $this->db->escape_like_str($data->courseid);
		$statusdata=array(
				 "active_flag"=>$this->db->escape_like_str($data->activeflag)
				);
		$array = array('class_id' => $chkclassid,'course_id' => $chkcourseid);
		$this->db->where($array);
		// return $this->db->delete('course_class');

		return $this->db->update("course_class",$statusdata);
	}

	//get class student lst
	function get_class_student_lst($data){
		$chkclassid = $this->db->escape_like_str($data->classid);
		$this->db->select("s.*");
		$this->db->from("student s");
		$this->db->join("student_class as sc", 'sc.student_id = s.student_id', 'left');
		$array = array('sc.class_id' => $chkclassid);
		$this->db->where($array);
		$this->db->order_by("student_id","desc");
		$q=$this->db->get();

		return $q->result();
	}

	//add new student
	function add_new_student($data){
		$classid = $this->db->escape_like_str($data->classid);
		$studentdata=array(
				 "name"=>$this->db->escape_like_str($data->studentname),
				 "address"=>$this->db->escape_like_str($data->address),
				 "contact"=>$this->db->escape_like_str($data->contact),
				 "location"=>$this->db->escape_like_str($data->location),
				 "gender"=>$this->db->escape_like_str($data->gender),
				 "date_of_birth"=>$this->db->escape_like_str($data->dob),
				 "nrc_no"=>$this->db->escape_like_str($data->nrc),
				 "father_name"=>$this->db->escape_like_str($data->fathername),
				 "father_nrc_no"=>$this->db->escape_like_str($data->fathernrc),				 
				 "mother_name"=>$this->db->escape_like_str($data->mothername),
				 "mother_nrc_no"=>$this->db->escape_like_str($data->mothernrc),				 	
				 "remark"=>$this->db->escape_like_str($data->remark),
				 "is_active"=>1
				);

		if($this->db->insert("student",$studentdata)){
			$studentid = $this->db->insert_id();
			$classstudata=array(
					"class_id"=>$classid,
					"student_id"=>$studentid,
					"active_flag"=>1
				);
			return $this->db->insert("student_class",$classstudata);
		}
	}

	//add assign student
	function add_assign_student($data){
		$studentdata=array(
				 "class_id"=>$this->db->escape_like_str($data->classid),
				 "student_id"=>$this->db->escape_like_str($data->studentid),
				 "active_flag"=>1
				);

		return $this->db->insert("student_class",$studentdata);
	}

	//get no class student lst
	function get_noclass_student_lst(){
		$selectsql = "select s.* 
						from student as s 
						left join student_class as sc on sc.student_id = s.student_id 
						where sc.class_id is null";
		$query = $this->db->query($selectsql);
		return $query->result();
	}
}
?>