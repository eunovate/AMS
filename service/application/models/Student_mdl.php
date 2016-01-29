<?php
class Student_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getstudentlist(){
		$this->db->select("*");
		$this->db->from("student");
		$this->db->order_by("student_id","desc");
		$q=$this->db->get();

		return $q->result();
	}

	public function savestudent($data){

		if(!isset($data->nrc)){
			$data->nrc="";
		}

		if(!isset($data->fname)){
			$data->fname="";
		}

		if(!isset($data->fnrc)){
			$data->fnrc="";
		}

		if(!isset($data->mname)){
			$data->mname="";
		}
		
		if(!isset($data->mnrc)){
			$data->mnrc="";
		}

		if(!isset($data->remark)){
			$data->remark="";
		}

		$d=array(
				 "name"=>$data->name,
				 "address"=>$data->address,
				 "contact"=>$data->contact,
				 "location"=>$data->location,
				 "gender"=>$data->gender,
				 "date_of_birth"=>$data->dateofbirth,
				 "nrc_no"=>$data->nrc,
				 "father_name"=>$data->fname,
				 "father_nrc_no"=>$data->fnrc,				 
				 "mother_name"=>$data->mname,
				 "mother_nrc_no"=>$data->mnrc,				 	
				 "remark"=>$data->remark,
				 "alias"=>$this->db->escape_like_str($data->alias),
				 "age"=>$this->db->escape_like_str($data->age),
				 "nationality"=>$this->db->escape_like_str($data->nationality),
				 "parent_job"=>$this->db->escape_like_str($data->parent_job),
				 "parent_address"=>$this->db->escape_like_str($data->parent_address),
				 "sibling_total"=>$this->db->escape_like_str($data->sibling_total),
				 "education_background"=>$this->db->escape_like_str($data->education_background),
				 "hobbies"=>$this->db->escape_like_str($data->hobbies),
				 "current_job"=>$this->db->escape_like_str($data->current_job),
				 "post_job"=>$this->db->escape_like_str($data->post_job),
				 "is_active"=>1
				);

		return $this->db->insert("student",$d);
	}

	public function updatestudent($data){
		if(!isset($data->nrc)){
			$data->nrc="";
		}

		if(!isset($data->fname)){
			$data->fname="";
		}

		if(!isset($data->fnrc)){
			$data->fnrc="";
		}

		if(!isset($data->mname)){
			$data->mname="";
		}
		
		if(!isset($data->mnrc)){
			$data->mnrc="";
		}

		if(!isset($data->remark)){
			$data->remark="";
		}

		$d=array(
				 "name"=>$data->name,
				 "address"=>$data->address,
				 "contact"=>$data->contact,
				 "location"=>$data->location,
				 "gender"=>$data->gender,
				 "date_of_birth"=>$data->dateofbirth,
				 "nrc_no"=>$data->nrc,
				 "father_name"=>$data->fname,
				 "father_nrc_no"=>$data->fnrc,				 
				 "mother_name"=>$data->mname,
				 "mother_nrc_no"=>$data->mnrc,				 	
				 "remark"=>$data->remark,
				 "alias"=>$this->db->escape_like_str($data->alias),
				 "age"=>$this->db->escape_like_str($data->age),
				 "nationality"=>$this->db->escape_like_str($data->nationality),
				 "parent_job"=>$this->db->escape_like_str($data->parent_job),
				 "parent_address"=>$this->db->escape_like_str($data->parent_address),
				 "sibling_total"=>$this->db->escape_like_str($data->sibling_total),
				 "education_background"=>$this->db->escape_like_str($data->education_background),
				 "hobbies"=>$this->db->escape_like_str($data->hobbies),
				 "current_job"=>$this->db->escape_like_str($data->current_job),
				 "post_job"=>$this->db->escape_like_str($data->post_job),
				 "is_active"=>$data->is_active
				);

		return $this->db->update("student",$d,array("student_id"=>$data->student_id));
	}

	public function getstudentdtl($id){
		$this->db->select("*");
		$this->db->from("student");
		$this->db->where(array("student_id"=>$id));
		$this->db->order_by("student_id","desc");
		$q=$this->db->get();

		return $q->row();
	}

	//get student class list
	function get_stu_class_list($data){
		$chkstuid = $this->db->escape_like_str($data->studentid);
		$selectsql = "select s.student_id, s.name, c.class_id, c.class_name, sc.active_flag  
						from student as s 
						join student_class as sc on sc.student_id = s.student_id 
						left join class as c on c.class_id = sc.class_id 
						where s.student_id =?";
		
		$query = $this->db->query($selectsql,array($chkstuid));

		return $query->result();
	}

	//get student course list
	function get_stu_course_list($studentid){
		$chkstuid = $this->db->escape_like_str($studentid);
		$selectsql = "select s.student_id, s.name, c.course_id, c.description as coursename, sc.active_flag  
						from student as s 
						join student_class as sc on sc.student_id = s.student_id 
						join course_class as cc on cc.class_id = sc.class_id 
						join course as c on c.course_id = cc.course_id 
						where s.student_id =? and sc.active_flag=1";
		
		$query = $this->db->query($selectsql,array($chkstuid));

		return $query->result();
	}

	//update class status from student
	function update_class_status($data){
		$chkstuid = $this->db->escape_like_str($data->stuid);
		$chkclassid = $this->db->escape_like_str($data->classid);
		$statusdata=array(
				 "active_flag"=>$this->db->escape_like_str($data->activeflag)
				);
		$array = array('class_id' => $chkclassid,'student_id' => $chkstuid);
		$this->db->where($array);
		// return $this->db->delete('course_class');

		return $this->db->update("student_class",$statusdata);
	}

	//get student not join class lst
	function get_student_notjoin_lst($data){
		$chkstuid = $this->db->escape_like_str($data->stuid);
		$selectsql = "select sc.student_id, c.* 
						from class as c 
						left outer join (SELECT * FROM student_class as psc WHERE psc.student_id=?) as sc on c.class_id = sc.class_id where sc.student_id is null
                        and c.active_flag=1";
		$query = $this->db->query($selectsql,array($chkstuid));
		return $query->result();
	}

	//add assign class
	function add_assign_class($data){
		$chkstuid = $this->db->escape_like_str($data->stuid);
		$chkclassid = $this->db->escape_like_str($data->classid);
		$d=array(
				 "class_id"=>$chkclassid,
				 "student_id"=>$chkstuid,
				 "active_flag"=>1
				);

		return $this->db->insert("student_class",$d);
	}
}
?>