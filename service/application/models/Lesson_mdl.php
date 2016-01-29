<?php
class Lesson_mdl extends CI_Model{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getlessonlist(){
		$q=$this->db->query("SELECT l.*,c.description as course
							 FROM lesson as l
							 LEFT JOIN course as c ON(c.course_id=l.course_id)
							 GROUP BY l.lesson_id
							 ORDER BY l.course_id DESC;");

		return $q->result();
	}

	public function savelesson($data){
		$d=array("course_id"=>$data->courseid,
				"description"=>$data->lesson);

		$this->db->insert("lesson",$d);
		return true;
	}

	public function updatelesson($data){
		$d=array("course_id"=>$data->courseid,
				"description"=>$data->lesson);

		$this->db->update("lesson",$d,array("lesson_id"=>$data->lessonid));
		return true;
	}
}
?>