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
$servername = "localhost";
$username = "root";
$password = "skku";
$dbname = "I2NSF_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$Policy_name = $_POST["Policy_name"];
$Client_IP = $_POST["Client_IP"];
$Dest_IP = $_POST["Dest_IP"];
$Caller_location = $_POST["Src_Country"];
$Callee_location = $_POST["Dest_Country"];
$Start_time = $_POST["Starting_Time"];
$End_time = $_POST["Ending_Time"];
$Action = $_POST["Action"];

$sql = "INSERT INTO Policies (Policy_name, Client_IP, Dest_IP, Caller_location, Callee_location, Start_time, End_time, Action) VALUES ('$Policy_name' , '$Client_IP', '$Dest_IP', '$Caller_location', '$Callee_location', '$Start_time', '$End_time', '$Action')";

$result = mysqli_query($conn, $sql);
/*if ($result) {
	echo "New record created successfully". "<br>";
	
	
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

*/


$sql = "SELECT * FROM Policies ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)){

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
$xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><I2NSF></I2NSF>');
array_to_xml($data, $xml_data);
$xml_result = $xml_data -> asXML();
header('Content-Type: text/xml; charset=UTF-8');
$dom = new DOMDocument();
$dom->loadXML($xml_result);
$dom->formatOutput = true;
$formattedXML = $dom->saveXML();
}

$fp = fopen("Dark_Knight.xml","wb");
fwrite($fp, $formattedXML);
fclose($fp); 

$date = date_create("NOW");
$file = 'policy.txt';
$test = date_format($date,"Y/m/d H:i:s") . '-' . $_POST["Policy_name"] . '-' . $_POST["Client_IP"] . '-' . $_POST["Dest_IP"] . '-' . $_POST["Src_Country"] . '-' . $_POST["Dest_Country"] . '-' . $_POST["Starting_Time"] . '-' . $_POST["Ending_Time"] . '-' . $_POST['Action'] . "\n";
$ret = file_put_contents($file, $test, FILE_APPEND | LOCK_EX);
echo nl2br('<span style="color:#FF0000;text-align:center;">Success!!<br><br>You will be redirected to Page1 in few seconds!</span>');
header( "refresh:3;url=policyname.php" );


/*echo json_encode($data);*/



mysqli_close($conn);

header("refresh:0;url=qfc.php/api/Policies");


/*
$url = "http://localhost/policy.txt";


$postvars='';

$sep='';

foreach($data as $key=>$value)
{
        $postvars.= $sep.urlencode($key).'='.urlencode($value);
        $sep='&';
}

echo $postvars;

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($data));
curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$result = curl_exec($ch);

curl_close($ch);

echo $result;

*/



?>
