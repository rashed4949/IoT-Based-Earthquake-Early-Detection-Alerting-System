<!--
  Rui Santos
  Complete project details at https://RandomNerdTutorials.com
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.

-->
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




$sql = "SELECT id, value1, value2, value3, reading_time FROM SensorData WHERE value1 > 1800 order by reading_time desc limit 40";

$result = $conn->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)){
    $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');

// ******* Uncomment to convert readings time array to your timezone ********
/*$i = 0;
foreach ($readings_time as $reading){
    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading - 1 hours"));
    // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
    //$readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 4 hours"));
    $i += 1;
}*/

$value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

/*echo $value1;
echo $value2;
echo $value3;
echo $reading_time;*/

//$result->free();
$conn=null;
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
  background-color: #e64741;
}

th, td {
  text-align: left;
  padding: 8px;
}

#blank{
      background-color: #FFFFFF;
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
<table>

<tr><td></td>
<td></td></tr>
  <tr>
    <td><h2>Sensor Readings of Earthquake in Real Time Charts</h2></td>
    <td>
    
    <button class="btn"><a href = "http://localhost:8080/Final/index.php" style = "text-decoration: none; color: white;"><i class="fa fa-home"></i> Home</button></td>
    
  </tr>
  <tr><td></td>
  <td></td></tr>
 
</table>
 
    
<table id="blank">

<tr><td></td>
<td></td></tr>
  <tr>
    <td><h2></h2></td>
    <td>
 
    
  </tr>
  <tr><td></td>
  <td></td></tr>
 
</table>
    
    
    
    
    <div id="chart-temperature" class="container"></div>
   
<script>

var value1 = <?php echo $value1; ?>;

var reading_time = <?php echo $reading_time; ?>;

var chartT = new Highcharts.Chart({
  chart:{ renderTo : 'chart-temperature' },
  title: { text: 'Sensor Data' },
  series: [{
    showInLegend: false,
    data: value1
  }],
  plotOptions: {
    line: { animation: false,
      dataLabels: { enabled: true }
    },
    series: { color: '#FF3333' }
  },
  xAxis: { 
    type: 'datetime',
    categories: reading_time
  },
  yAxis: {
    title: { text: 'Sensor Data' }
    //title: { text: 'Temperature (Fahrenheit)' }
  },
  credits: { enabled: false }
});



</script>
</body>
</html>