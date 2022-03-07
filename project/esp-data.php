
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

$sql = "SELECT id, value1, value2, value3, reading_time FROM SensorData order by reading_time desc limit 40";

$result = $conn->query($sql);

	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
    $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');

$value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

$conn = null;
?>

<!DOCTYPE html>
<html>
      <head>
       <title>Sensor Data</title>
<meta http-equiv="refresh" content="15">  
          
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- Data Tables -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
  <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- Modal CSS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
  
  <style>
 
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: black;
  color: white;
}

#blank{
      background-color: #FFFFFF;
}


#t01 {
  width: 100%;
  background-color: #e64741;

}

#tr01 {
  width: 100%;
  background-color: #e64741;

}


 h2 {
      font-family: Arial;
      font-size: 2.5rem;
      text-align: center;
      color: white;
    }
.btn {
  background-color: black;
  border: none;
  color: white;
  padding: 12px 16px;
  font-size: 16px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: #25383C;
}

  </style>
  </head> 
  <body>
<table id="t01">

<tr id="tr01"><td></td>
<td></td></tr>
  <tr id="tr01">
    <td><h2>Real Time Sensor Data</h2></td>
    <td>
    
    <button class="btn"><a href = "http://localhost:8080/Final/index.php" style = "text-decoration: none; color: white;"><i class="fa fa-home"></i> Home</button></td>
    
  </tr>
  <tr id="tr01"><td></td>
  <td></td></tr>
 
</table>
 
    
<table id="blank">

<tr><td>
    
    
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

$sql = "SELECT id, sensor, location, value1, reading_time FROM SensorData ORDER BY id DESC";

echo '<table>
      <tr> 
        <th>ID</th> 
        <th>Sensor</th> 
        <th>Location</th> 
        <th>Sensor Data</th> 
      
        <th>Timestamp</th> 
      </tr>';
 
if ($result = $conn->query($sql)) {
   	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
      
        $row_reading_time = $row["reading_time"];
        $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 6 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_value1 . '</td> 
               
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
}

$conn=null;
?> 
</table>   

   
    
</td>
</tr>

 
</table>
 
 

</body>
</html>