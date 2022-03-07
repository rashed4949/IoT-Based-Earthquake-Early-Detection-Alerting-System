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
// INSERT EMAIL ADDRESS

    $msg = '';
    $msgClass = '';
    
    if(isset($_POST['submit'])){
        $email_address     = $_POST['email_address'];
        

        $sql = "INSERT INTO email(email_address) VALUES('$email_address')";
		$result = $conn->query($sql);

        //$result = mysqli_query($conn, $sql);
        if($result) {
            $msg = "Data inserted successfully";
            $msgClass="alert-success";
        }
        else {
            $msg = "Data not inserted";
            $msgClass="alert-danger";
        }
    }

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
<title>Project</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit="no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- favicons -->

<!-- favicons -->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/custom-responsive-style.css">



   <!-- Modal CSS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>



<script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="scripts/plugin-active.js"></script>



</head>
<body>
  <header>

  </header>
<section id="Banner">
  <div class="logo">
  </div>
  <div class="blacksection">
    <h1>IoT Based EarthQuake Early Detection and Alarming System</h1> 
    
  </div>
</section>
<a href="#Services" class="mscroll"><img src="images/mouse-icon.png" alt="mouse icon"></a>
<section id="Services">
  <div class="container">
    <h2>Our Project Features</h2>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="each-services">
            <a href="http://localhost:8080/esp-data.php">
        <img src="images/web-hosting.jpg" alt="Services">
        </a>
          <h3>Real Time Data </h3>
          <p> In this feature, user can find Real Time sensor Data</p>
         
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="each-services">
            <a href="http://localhost:8080/esp-chart.php">
          <img src="images/web-design.jpg" alt="Services">
             </a>
          <h3>Graphical &amp; Visualization of All Sensor Data</h3>
          <p>This feature visualize all Sensor Readings in Real Time Charts</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="each-services">
           <a href="http://localhost:8080/esp-chart_earthquake.php">
          <img src="images/web-design.jpg" alt="Services">
             </a>
          <h3>Graphical &amp; Visualization of Earthquake Data</h3>
          <p>This feature visualize Sensor of only Earthquake Readings in Real Time Charts</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="each-services">
           <img src="images/web-design.jpg" alt="Services">
          <h3>Notification</h3>
          <p>User can send their email address by this feature and get notification/Warning for Earthquake by email</p>
          
          <button type="button" class="btn btn-info btn-sm mb-5" style="float:center" data-toggle="modal" data-target="#myModal">Earthquake Alert Notification</button>
    
      <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Please Send your Email address to us</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <input type="text" name="email_address" class="form-control" placeholder="Enter Email Address">
            </div>
          
             

            <input type="submit" value="Submit" name="submit" class="btn btn-success btn-sm">
           </form> 
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
          
          
        </div>
      </div>
    </div>
  </div>
</section>

<footer id="Contact">
  <div class="container">
       <p>Submitted To </p>
   <h3 style="color: white; font-weight: bold; font-size: 20px;">Irfan Mirza</h3>
   <h3 style="color: white; font-weight: bold; font-size: 20px;"></h3>
      
    <p>Submitted By </p>
   <h3 style="color: white; font-weight: bold; font-size: 20px;">Naznin Yasmin  (26638)</h3>
   <h3 style="color: white; font-weight: bold; font-size: 20px;">Md Rashedul Islam (28367)</h3>
   <h3 style="color: white; font-weight: bold; font-size: 20px;">Muhammad Tanvir Hasan (27563)
</h3>
   <h3 style="color: white; font-weight: bold; font-size: 20px;">Mohammad Salahuddin (28269)</h3>
   <h3 style="color: white; font-weight: bold; font-size: 20px;">Md Jasim Uddin (28347)</h3>
    
  </div>
</footer>
 <div class="copyright"><p></p>
</div>
</body>
</html>