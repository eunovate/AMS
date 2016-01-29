<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Notification_ctrl extends base_ctrl{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Notification_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		//get noti data
		function getnotidata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$res=$this->model->get_user_noti_count($this->post());
				echo json_encode($res);	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get notify list
		function getnotifylist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_notify_list($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//update notify status
		function updatenotifystatus(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->notify_status($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}		
	}
?>