<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Lesson_ctrl extends base_ctrl{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Lesson_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function getlessonlist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getlessonlist();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function savelesson(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savelesson($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function updatelesson(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->updatelesson($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}		
	}
?>