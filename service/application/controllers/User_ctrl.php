<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class User_ctrl extends base_ctrl{
		function __construct(){
			parent::__construct();
			$this->load->model('User_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		//get user list 
		function getuserlist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getuserlist();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//save user 
		function saveuser(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$this->model->saveuser($this->post());
				echo json_encode(array("success"=>true));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//update user 
		function updateuser(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$this->model->updateuser($this->post());
				echo json_encode(array("success"=>true));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}						
		}

		//update status 
		function updatestatus(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$res=$this->model->updatestatus($this->post());
				echo json_encode(array("success"=>$res));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//reset user password
		function resetPassword(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$res=$this->model->resetPassword($this->post());
				echo json_encode(array("success"=>$res));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}				
		}

				/*Chg Password Dialog Functions*/
		function checkcurpass(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->checkcurpass($this->post());
				echo json_encode(array("exist"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		function chgpass(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->chgpass($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}


		/*User Group Functions*/
		function getrolelist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getrolelist();
				echo json_encode($data);	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function getgrouplist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getgrouplist();
				echo json_encode($data);	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function getactivegrouplist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getactivegrouplist();
				echo json_encode($data);	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function getuserdetail(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->getuserdetail($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		function saveusergroup(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$this->model->saveusergroup($this->post());
				echo json_encode(array("success"=>true));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		function updateusergroup(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$this->model->updateusergroup($this->post());
				echo json_encode(array("success"=>true));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function updategroupstatus(){	
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$res=$this->model->updategroupstatus($this->post());
				echo json_encode(array("success"=>$res));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

	}
?>