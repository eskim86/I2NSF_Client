<TYPE HTML>
<html>
<head>
<style>
.center {
    margin: left;
    width: 90%;
    border: 3px solid green;
    padding: 10px;
}
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #00FF00;
}

select {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: white;
}


div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.error {color: #FF0000;}
</style>
</head>
<body>

<?php 


$idErr = $snationErr = $rnationErr = $stimeErr = $etimeErr = $actErr = "";
$id = $nation = $act = $snation = $rnation = $stime = $etime =  "";
$errors = 0;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Policy_name"])||empty($_POST["Src_Country"])||empty($_POST["Dest_Country"])||empty($_POST["Starting_Time"])||empty($_POST["Starting_Time"])||empty($_POST["Ending_Time"])||empty($_POST["Action"])) {
    echo nl2br('<span style="color:#FF0000;text-align:center;">Please fill in all required fields.</span><br><br>');

    $errors++;
    header( "refresh:3;url=test3.php" );
    return $error;

  }else{

if (strlen($_POST["Policy_name"]) < 3) {
    echo nl2br('<span style="color:#FF0000;text-align:center;">Policy name must be at least 3 characters long.</span><br><br>');
    header( "refresh:3;url=test3.php" );
    $errors++;
    return $error;

  } else {
    if (strlen($_POST["Policy_name"]) > 32) {
    echo nl2br('<span style="color:#FF0000;text-align:center;">Policy name should be no longer than 32 characters.</span><br><br>');
    header( "refresh:3;url=test3.php" );
    $errors++;
    return $error;

    }else {
      $id = test_input($_POST["Policy_name"]);
  }
  
}


}
  
    if(count($error) > 0) {

    return false;
}else{



$date = date_create("NOW");
$file = 'policy.txt';
$test = date_format($date,"Y/m/d H:i:s") . '-' . $_POST["Policy_name"] . '-' . $_POST["Src_Country"] . '-' . $_POST["Dest_Country"] . '-' . $_POST["Starting_Time"] . '-' . $_POST["Ending_Time"] . '-' . $_POST["Action"] . "\n";
$ret = file_put_contents($file, $test, FILE_APPEND | LOCK_EX);


echo nl2br('<span style="color:#FF0000;text-align:center;"><br><br>Success!!<br><br></span>');


exit;

}



}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}




?>

<div class = "center">
<p><span class="error">* required field.</span></p>
<form method="post" id = "form" action="sample.php"> 

  <span class="error">* <?php echo $idErr;?></span>
  Policy Name: <br><br>
  <input type="text" name = "Policy_name" id = "Policy name">
  <br><br>
  <span class="error">* <?php echo $snationErr; ?></span>
  Caller's Location:<br><br>
  <select name="Src_Country" id = "Src Country">
  <option value="">Select...</option>
  <option value="US">United States</option>
  <option value="UK">United Kingdom</option>
  <option value="France">France</option>
  <option value="Mexico">Mexico</option>
  <option value="Russia">Russia</option>
  <option value="Japan">Japan</option>
  <option value="Africa">Africa</option>
  <option value="Korea">Republic of Korea</option>
  <option value="China">China</option>
  <option value="Spain">Spain</option>
  <option value="Italy">Italy</option>
  <option value="Germany">Germany</option>
  <option value="Austrailia">Austrailia</option>
  </select>
  <br><br>
  <span class="error">* <?php echo $rnationErr; ?></span>
  Callee's Location:<br><br>
  <select name="Dest_Country" id = "Dest Country">
  <option value="">Select...</option>
  <option value="US">United States</option>
  <option value="UK">United Kingdom</option>
  <option value="France">France</option>
  <option value="Mexico">Mexico</option>
  <option value="Russia">Russia</option>
  <option value="Japan">Japan</option>
  <option value="Africa">Africa</option>
  <option value="Korea">Republic of Korea</option>
  <option value="China">China</option>
  <option value="Spain">Spain</option>
  <option value="Italy">Italy</option>
  <option value="Germany">Germany</option>
  <option value="Austrailia">Austrailia</option>
  </select>
  <br><br>
  <span class="error">* <?php echo $stimeErr; ?></span>
  Starting Time :<br><br>
  <select name = "Starting_Time" id="Starting Time">
  <option value="">Select...</option>
  <option value="01:00">01:00</option>
  <option value="02:00">02:00</option>
  <option value="03:00">03:00</option>
  <option value="04:00">04:00</option>
  <option value="05:00">05:00</option>
  <option value="06:00">06:00</option>
  <option value="07:00">07:00</option>
  <option value="08:00">08:00</option>
  <option value="09:00">09:00</option>
  <option value="10:00">10:00</option>
  <option value="11:00">11:00</option>
  <option value="12:00">12:00</option>
  <option value="13:00">13:00</option>
  <option value="14:00">14:00</option>
  <option value="15:00">15:00</option>
  <option value="16:00">16:00</option>
  <option value="17:00">17:00</option>
  <option value="18:00">18:00</option>
  <option value="19:00">19:00</option>
  <option value="20:00">20:00</option>
  <option value="21:00">21:00</option>
  <option value="22:00">22:00</option>
  <option value="23:00">23:00</option>
  <option value="00:00">00:00</option>
  </select>
  <br><br>
  <span class="error">* <?php echo $etimeErr;?></span>
  Ending Time :<br><br>
  <select name = "Ending_Time" id="Ending Time">
  <option value="">Select...</option>
  <option value="01:00">01:00</option>
  <option value="02:00">02:00</option>
  <option value="03:00">03:00</option>
  <option value="04:00">04:00</option>
  <option value="05:00">05:00</option>
  <option value="06:00">06:00</option>
  <option value="07:00">07:00</option>
  <option value="08:00">08:00</option>
  <option value="09:00">09:00</option>
  <option value="10:00">10:00</option>
  <option value="11:00">11:00</option>
  <option value="12:00">12:00</option>
  <option value="13:00">13:00</option>
  <option value="14:00">14:00</option>
  <option value="15:00">15:00</option>
  <option value="16:00">16:00</option>
  <option value="17:00">17:00</option>
  <option value="18:00">18:00</option>
  <option value="19:00">19:00</option>
  <option value="20:00">20:00</option>
  <option value="21:00">21:00</option>
  <option value="22:00">22:00</option>
  <option value="23:00">23:00</option>
  <option value="00:00">00:00</option>
  </select>
  <br><br>
  <span class="error">* <?php echo $actErr;?></span>
  Action:<br><br>
  <select name="Action" id = "Action">
  <option value="">Select...</option>
  <option value="Block">Block</option>
  <option value="Unblock">Unblock</option>
  </select>
  <br><br>
<input type="submit" value="Submit"/>
</form>
</div>



</body>
</html>


