<?php



echo "hi";

$servername = "localhost";
$username = "root";
$password = "skku";
$dbname = "I2NSF_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "connected!". "<br>";


$Policy_name = $_POST["Policy_name"];
$Caller_location = $_POST["Src_Country"];
$Callee_location = $_POST["Dest_Country"];
$Start_time = $_POST["Starting_Time"];
$End_time = $_POST["Ending_Time"];
$Action = $_POST["Action"];

$sql = "INSERT INTO Policies (Policy_name, Caller_location, Callee_location, Start_time, End_time, Action) VALUES ('$Policy_name' , '$Caller_location', '$Callee_location', '$Start_time', '$End_time', '$Action')";

$result = mysqli_query($conn, $sql);
if ($result) {
	echo "New record created successfully". "<br>";
	
	
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}



$sql = "SELECT * FROM Policies ORDER BY Policy_name";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)){

$data[] = array(
'id'   => $row["id"],
'Policy_name' => $row["Policy_name"]
);
}
echo json_encode($data);



mysqli_close($conn);

?>
