<?php 
	
	require_once("MarketClass.php");
	
	$market = new Market();
	$menuRows = $market->GetMenuRecords();
	// print_r($menuRows);
	
		$new = array();
		foreach ($menuRows as $a){
				$new[$a['ProductParentID']][] = $a;
		}
		$tree = createTree($new, $new[0]); // changed
		// die(json_encode($tree));
		// print_r($tree);

	
	
	// $xml = new SimpleXMLElement('<root/>');
	// array_walk_recursive($tree, array ($xml, 'addChild'));
	// print $xml->asXML();

	function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
			if( is_array($value) ) {
            if( is_numeric($key) ){
                // $key = 'item'.$key; //dealing with <0/>..<n/> issues
                $key = 'item'; //for avoid <item0> , <item1>, etc,.
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
	}

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

// function call to convert array to xml
array_to_xml($tree,$xml_data);

//saving generated xml file; 
// $result = $xml_data->asXML('/file/path/name.xml');
print $xml_data->asXML();
	
	


function createTree(&$list, $parent){
			$tree = array();
			foreach ($parent as $k=>$l){
					if(isset($list[$l['ProductID']])){
							$l['children'] = createTree($list, $list[$l['ProductID']]);
					}
					$tree[] = $l;
			}
			return $tree;
	}