<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Student_ctrl extends base_ctrl{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Student_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function getstudentlist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getstudentlist();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function savestudent(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savestudent($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function updatestudent(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->updatestudent($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function getstudentdtl(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getstudentdtl($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}		

		//get student class list
		function getstuclasslist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_stu_class_list($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//get student course list
		function getstucourselist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_stu_course_list($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//update class status from student
		function updateclassstatus(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_class_status($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get student not join class list
		function getstunotclasslist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_student_notjoin_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//add assign class
		function addassignclass(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_assign_class($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}
	}
?>