<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Schedule_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->headers = apache_request_headers();
			$this->load->model('Schedule_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function post(){
			return json_decode(file_get_contents("php://input"));
		}

		//get all schedule list 
		function getschedulelst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_schedule_lst($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get class lst
		function getscheduledata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data['classlst'] =$this->model->get_class_lst();
				$data['courselst'] =$this->model->get_course_lst();
				$data['lessonlst'] = $this->model->get_lesson_lst();
				$data['vehiclelst'] = $this->model->get_vehicle_lst();
				$data['driverlst'] = $this->model->get_driver_lst();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add schedule data
		function addscheduledata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_schedule_data($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//update schedule data
		function updatescheduledata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_schedule_data($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get all teacher list 
		function getteacherlst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_teacher_lst();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//check main teacher assign
		function checkmteacherasg(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->check_mteacher_assign($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add assign teacher on schedule person
		function addasgteachers(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_assign_teachers($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get ta list for this schedule
		function gettalst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data['talst'] =$this->model->get_ta_lst($this->post());
				$data['driverdata'] =$this->model->get_driver_info($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//del ta data from this schedule
		function deltadata(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->del_ta_data($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}


		//get behaviour rating list
		function getscheduledetail(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data['bratingdata']=$this->model->behaviour_rating_lst($this->post());
				$data['attenddata']=$this->model->attend_count_data($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get student rating list
		function getsturatinglst(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data['ratingdata']=$this->model->student_behaviour_rating_data($this->post());
				$data['stuabsentdata']=$this->model->get_stu_absent_data($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}
		
	}
?>