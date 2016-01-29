<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Staff_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->headers = apache_request_headers();
			$this->load->model('Staff_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		
		//get staff all schedule list 
		function getstaffschedulelst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_staff_schedule_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}
	}
?>