<?php 

class Market{
	
	private $conn;
	
	public function __construct(){
		$this->conn = mysqli_connect("localhost", "root","","bookmarket") or die(mysqli_error($this->conn));
	}
	
	public function GetMenuRecords(){
		$sql = "select * from category";
		$result = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
		if($result){
			$returnArray = array();
			while($row = mysqli_fetch_assoc($result)){
				$returnArray[] = $row;
			}
			return $returnArray;
		}
	}
	
	
	/*
	query to fetch menus of logged in user 
	SELECT cat.* FROM `category` cat join usercategory ucat on cat.categoryID = ucat.id and ucat.userid=1 and ucat.isdeleted=0 and ucat.ispaymentcomplete=1
	*/
	
	private function check_login($userid, $activationCode){
		$check_query = "select * from usercategory where userid = ".trim($userid)." and activationcode = '".trim($activationCode)."';";
		$check_result = mysqli_query($this->conn, $check_query) or die('ERROR: Could not check for login');
		if(mysqli_num_rows($check_result) > 0){
			return true;	
		}
		return false;
	}
	
	public function SubmitLogin($payload=''){
		if(isset($_REQUEST['wsdl'])){
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
	
	public function GetJSONMenu($payload = ''){
		return json_encode($this->GetMenuRecords());
	}
	
	public function GetXMLMenu($payload = ''){
		$menuRows = $this->GetMenuRecords();
		$new = array();
		foreach ($menuRows as $a){
				$new[$a['ProductParentID']][] = $a;
		}
		$tree = $this->createTree($new, $new[0]); // changed
		
		// creating object of SimpleXMLElement
		$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

		// function call to convert array to xml
		$this->array_to_xml($tree,$xml_data);

		//saving generated xml file; 
		// $result = $xml_data->asXML('/file/path/name.xml');
		return base64_encode($xml_data->asXML());
	}
	
	private function createTree(&$list, $parent){
			$tree = array();
			foreach ($parent as $k=>$l){
					if(isset($list[$l['ProductID']])){
							$l['children'] = $this->createTree($list, $list[$l['ProductID']]);
					}
					$tree[] = $l;
			}
			return $tree;
	}
	
	private function array_to_xml( $data, &$xml_data ) {
		foreach( $data as $key => $value ) {
			if( is_array($value) ) {
						if( is_numeric($key) ){
								// $key = 'item'.$key; //dealing with <0/>..<n/> issues
								$key = 'item'; //for avoid <item0> , <item1>, etc,.
						}
						$subnode = $xml_data->addChild($key);
						$this->array_to_xml($value, $subnode);
				} else {
						$xml_data->addChild("$key",htmlspecialchars("$value"));
				}
		 }
	}

}