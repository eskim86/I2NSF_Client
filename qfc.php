<?php
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if(is_numeric($key)){
                $key = 'Policies';
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild($key, htmlspecialchars($value));
        }
    }
}

error_reporting(E_ALL);
ini_set("display_errors", 1);

$servername = "localhost";
$username = "root";
$password = "skku";
$dbname = "I2NSF_DB";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$url = $_SERVER["REQUEST_URI"];

if($url == "/qfc.php/api/Policies"){
		// Retrieves all robots
		$sql = "SELECT * FROM Policies ORDER BY id DESC limit 1";
		$sql_result = $conn->query($sql);

		$data = array();

		while ($row = $sql_result->fetch_assoc()){
			$data[] = array(
			    'id' => $row["id"],
			    'Policy_name' => $row["Policy_name"],
			    'Position' => $row["Position"],
			    'Website' => $row["Web"],
			    'Start_time' => $row["Start_time"],
			    'End_time' => $row["End_time"],
			    'Action' => $row["Action"]

		       	);
		
		
		}
		$xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><I2NSF></I2NSF>');
		array_to_xml($data, $xml_data);
		$xml_result = $xml_data -> asXML();
		header('Content-Type: text/xml; charset=UTF-8');
		$dom = new DOMDocument();
		$dom->loadXML($xml_result);
		$dom->formatOutput = true;
		$formattedXML = $dom->saveXML();
		echo $formattedXML;
		/*echo json_encode($data);*/
	}


?>

