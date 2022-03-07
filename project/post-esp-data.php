<?php

//pdo
$dbhost = "localhost";
$username = "root";
$password = "12345";
$dbname = "rownmrbo_db_earthquake";

try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$username,$password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT email_address FROM email WHERE send_email=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $email_address =  $row["email_address"]  ;
  }
} else {
  echo "0 results";
}
$conn->close();

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $sensor = $location = $value1 = $value2 = $value3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sensor = test_input($_POST["sensor"]);
        $location = test_input($_POST["location"]);
        $value1 = test_input($_POST["value1"]);
        $value2 = test_input($_POST["value2"]);
        $value3 = test_input($_POST["value3"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO SensorData (sensor, location, value1, value2, value3)
        VALUES ('" . $sensor . "', '" . $location . "', '" . $value1 . "', '" . $value2 . "', '" . $value3 . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
        
       $email_msg = "Sensor Data: " . $value1;
        
        $email_msg = wordwrap($email_msg, 70);
        
        if($value1 < 1800){
            echo "Earthquake Probability is here !";
            exit;
        }
    
    mail($email_address, "[NEW] Earthquake Alert ", $email_msg);
        echo "Email sent";
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



