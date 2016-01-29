<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_mdl extends CI_Model{
	
	public function __construct(){
		// load database
		$this->load->database();
	}

	// get all user list
	function getuserlist(){
		$query = $this->db->query("SELECT u.*,ug.group_name FROM user as u
								  LEFT JOIN user_group as ug ON(ug.user_gp_id=u.user_gp_id)
								  GROUP BY u.user_id");
		return $query->result();
	}

	// save user 
	function saveuser($data){
		$data = array(
			'user_gp_id'=>$data->group_id,
			'name' => $this->db->escape_like_str($data->name),
			'user_name' => $this->db->escape_like_str($data->username),
			'password' => md5($this->db->escape_like_str($data->password)),
			'phone' => $this->db->escape_like_str($data->phone),
			'email' => $this->db->escape_like_str($data->email),
			'address' => $this->db->escape_like_str($data->address),
			'nrc_no' => $this->db->escape_like_str($data->nrcno),
			'gender' => $this->db->escape_like_str($data->gender),
			'is_active' => 1);
		return $this->db->insert('user',$data);
	}

	// update user
	function updateuser($data)
	{
		$id = $this->db->escape_like_str($data->userid);
		$data = array(
			'user_gp_id'=>$data->group_id,
			'name' => $this->db->escape_like_str($data->name),
			'phone' => $this->db->escape_like_str($data->phone),
			'email' => $this->db->escape_like_str($data->email),
			'address' => $this->db->escape_like_str($data->address),
			'nrc_no' => $this->db->escape_like_str($data->nrcno),
			'gender' => $this->db->escape_like_str($data->gender)
			);
		$this->db->where('user_id',$id);
		return $this->db->update('user',$data);
	}


   function updatestatus($data){
		$d=array("is_active"=>$data->active);

		$res=$this->db->update("user",$d,array("user_id"=>$data->userid));
		return true;
	}

	//user change password
	function resetPassword($data){		
		$id = $this->db->escape_like_str($data->userid);
		$data = array('password'=>md5($this->db->escape_like_str($data->pass)));
		$this->db->where('user_id',$id);
		return $this->db->update('user',$data);
	}


	/*Change Password Functions*/
	public function checkcurpass($data){
		$encrypt=md5($data->curpass);
		$res=$this->db->query("SELECT * FROM user WHERE password='$encrypt' AND user_id=$data->userid;");

		if($res->num_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}

	public function chgpass($data){
		$encrypt=md5($data->pass);

		$res=$this->db->query("UPDATE user SET password='$encrypt'
						 WHERE user_id=$data->userid;");
		return true;
	}

	/*User Group Functions*/
	function getuserdetail($id){
		$this->db->select();
		$this->db->from('user');
		$this->db->where(array("user_gp_id"=>$id));
		$query = $this->db->get();
		return $query->result();
	}

	function getrolelist(){
		$this->db->select();
		$this->db->from('role');
		$query = $this->db->get();
		return $query->result();
	}

	function getgrouplist(){
		$query=$this->db->query("SELECT ug.*,r.role_id,r.description as role FROM user_group as ug
						  LEFT JOIN role as r ON(ug.role_id=r.role_id)
						  GROUP BY ug.user_gp_id");
		return $query->result();
	}

	function getactivegrouplist(){
		$query=$this->db->query("SELECT ug.* FROM user_group as ug
						  WHERE ug.active_flag=1
						  GROUP BY ug.user_gp_id");
		return $query->result();
	}

	function saveusergroup($data){
		$data = array('group_name' => $data->gpname,
					  'role_id' => $data->roleid,
					  'accesscontrol' => $data->permission,
					  'active_flag' => 0);
		return $this->db->insert('user_group',$data);
	}

	function updateusergroup($d){
		$data = array('group_name' => $d->gpname,
					'role_id' => $d->roleid,
					'accesscontrol' => $d->permission);
		return $this->db->update('user_group',$data,array("user_gp_id"=>$d->groupid));
	}

	function updategroupstatus($data){
		$d=array("active_flag"=>$data->active);

		$res=$this->db->update("user_group",$d,array("user_gp_id"=>$data->groupid));
		return true;
	}

}