<?php 

class Market{
	
	private $conn;
	
	public function __construct(){
		$this->conn = mysqli_connect("localhost", "root","","bookmarket") or die(mysqli_error($this->conn));
	}
	
	private function check_login($userid, $activationCode){
		$check_query = "select * from usercategory where userid = ".trim($userid)." and activationcode = '".trim($activationCode)."';";
		$check_result = mysqli_query($this->conn, $check_query) or die('ERROR: Could not check for login');
		if(mysqli_num_rows($check_result) > 0){
			return true;	
		}
		return false;
	}
	
	public function SubmitLogin($payload=''){
			$jsonDecoded = json_decode($payload, true);
			$userid =  $jsonDecoded['userid'];
			$activationcode =  $jsonDecoded['activationcode'];
			if($this->check_login($userid, $activationcode)){
				return "SUCCESS";
			}else{
				return "FAILURE";
			}
	}
}