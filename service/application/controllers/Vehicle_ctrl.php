<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Vehicle_ctrl extends base_ctrl{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Vehicle_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function getvehiclelist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getvehiclelist();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}

		}

		function savevehicle(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savevehicle($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function updatevehicle(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->updatevehicle($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function getvehicledtl(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getvehicledtl($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function getvehicleusage(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getvehicleusage($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function savevehicleusage(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savevehicleusage($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function getmaintenance(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getmaintenance($this->post());
				echo json_encode($data);	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function savemaintenance(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->savemaintenance($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		//get all vehicle schedule list 
		function getvehicleschedulelst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_vehicle_schedule_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get vehicle usage location list
		function getvuloclist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_vu_location_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		// //update vehicle usage
		// function updatevehicleusage(){
		// 	$res=$this->auth_chk();
		// 	if(isset($res["trust"])){
		// 		$data =$this->model->update_vehicle_usage($this->post());
		// 		echo json_encode(array("success"=>$data));
		// 	}else{
		// 		echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
		// 	}
		// }

		//add start odometer
		function addstartodom(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_start_odometer($this->post());
				echo json_encode(array("success"=>true,"data"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//update start odometer
		function updatestartodom(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_start_odometer($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add location
		function addvulocation(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_vu_location($this->post());
				echo json_encode(array("success"=>true,"data"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add emd odometer
		function addendodom(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_end_odometer($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//update end odometer
		function updateendodom(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_end_odometer($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//del location data
		function dellocdata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->del_location_data($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get vehicle usage all location list
		function getvuallloclist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_vu_alllocation_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}
	}
?>