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
		$sql = "SELECT * FROM Policies ORDER BY id";
		$sql_result = $conn->query($sql);

		$data = array();

		while ($row = $sql_result->fetch_assoc()){
			$data[] = array(
			    'id' => $row["id"],
			    'Policy_name' => $row["Policy_name"],
			    'Client_IP' => $row["Client_IP"],
			    'Dest_IP' => $row["Dest_IP"],
			    'Caller_location' => $row["Caller_location"],
			    'Callee_location' => $row["Callee_location"],
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
else{

$params = explode("/",$url);
	if($params[4] == "search"){
		// Searches for robots with $name in their name
		$sql = "SELECT * FROM Policies WHERE Policy_name LIKE '%$params[4]%' ORDER BY Policy_name";
		$sql_result = $conn->query($sql);
		$data = array();
		while ($row = $sql_result->fetch_assoc()){
			$data[] = array(
			    'id' => $row["id"], 
			    'Policy_name' => $row["Policy_name"],
			    'Client_IP' => $row["Client_IP"],
			    'Dest_IP' => $row["Dest_IP"],
			    'Caller_location' => $row["Caller_location"],
			    'Callee_location' => $row["Callee_location"],
			    'Start_time' => $row["Start_time"],
			    'End_time' => $row["End_time"],
			    'Action' => $row["Action"]
		       	);
		}
		echo json_encode($data);
	}elseif($_SERVER['REQUEST_METHOD'] == 'PUT') {
		$put_body = file_get_contents('php://input');
		
		// Updates a robot
		$info = json_decode($put_body);
		$sql = "UPDATE Policies SET Policy_name = '$info->Policy_name', Client_IP = '$info->Client_IP', Dest_IP = '$info->Dest_IP', Caller_location = '$info->Caller_location', Callee_location = '$info->Callee_location', Start_time = '$info->Start_time', End_time = '$info->End_time', Action = '$info->Action', WHERE id = $params[4]";
		if ($conn->query($sql) === TRUE) {
		   echo "Updated successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}elseif($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		
		// Deletes a robot
		$sql = "DELETE FROM Policies WHERE id = $params[4]";
		if ($conn->query($sql) === TRUE) {
		   echo "Deleted successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else{
		
		// Retrieves robots based on primary key
		$sql = "SELECT * FROM Policies WHERE id = $params[4]";
		$sql_result = $conn->query($sql);
		$data = array();
		while ($row = $sql_result->fetch_assoc()){
			$data[] = array(
			    'id' => $row["id"], 
			    'Policy_name' => $row["Policy_name"],
			    'Client_IP' => $row["Client_IP"],
			    'Dest_IP' => $row["Dest_IP"],
			    'Caller_location' => $row["Caller_location"],
			    'Callee_location' => $row["Callee_location"],
			    'Start_time' => $row["Start_time"],
			    'End_time' => $row["End_time"],
			    'Action' => $row["Action"]
		       	);
		}
		echo json_encode($data);
	}

}




?>
