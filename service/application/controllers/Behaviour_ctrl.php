<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Behaviour_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Behaviour_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function getbehaviourlst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_behaviour_list();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function addbehaviour(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_behaviour($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function updatebehaviour(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_behaviour($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}	
	}
?>