<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Course_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->headers = apache_request_headers();
			$this->load->model('Course_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function getcourselist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getcourselist();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function savecourse(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savecourse($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function updatecourse(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->updatecourse($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}	

		//add course data
		function addcoursedata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_course_data($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get course data
		function getcoursedtl(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_course_data($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//get all course schedule list 
		function getcourseschedulelst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_course_schedule_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}
	}
?>