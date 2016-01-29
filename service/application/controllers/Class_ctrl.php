<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Class_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Class_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function getclasslist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getclasslist();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function getlocation(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getlocation();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function getclassdtl(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getclassdtl($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function getclasscourse(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getclasscourse($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function saveclass(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->saveclass($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function updateclass(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->updateclass($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}	

		function savelocation(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savelocation($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}	

		//get all class schedule list 
		function getclassschedulelst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_class_schedule_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//update course status from class
		function updatecoursestatus(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_course_status($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get class student list 
		function getclassstulst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_class_student_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add new student
		function addnewstu(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_new_student($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get no class student list()
		function getnclassstulst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_noclass_student_lst();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add assign student
		function addassignstudent(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_assign_student($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}
	}
?>