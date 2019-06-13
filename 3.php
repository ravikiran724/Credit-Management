<?php
session_start();
$_POST=$_SESSION;
?>
<!DOCTYPE html>
<html>
<head>
<title>
Transaction Page
</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
.rr{
margin:auto;
width:8%;
}
#ddd{
background-color: #555555;
}
h1 {
margin-top:27px;
text-align:center;
font-size:27px;
}
.new {
 position: absolute;
  top: 0px;
  right: 0px;
 margin-right:30px;
margin-top:40px;
}
h1{
font-size:24px;
text-align:center;
margin-top:20px;
padding:20px;
}
</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "id9890111_root";
$password = "test1";
$database="id9890111_db";
$ut=(string) $_POST["un"];

$utt=( $_POST['cd'] );
$int = (is_numeric($_POST["cd"]) ? (int)$_POST["cd"] : 0);
$usErr="";
$conn=new mysqli($servername,$username,$password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id=$_POST['cddd'];
$sql = "UPDATE users SET Creditsavailable=Creditsavailable + $int WHERE Name='" .$ut. "'";

$conn->query($sql);

$sql = "UPDATE users SET Creditsavailable=Creditsavailable - $int WHERE Userid = $id";
if ($conn->query($sql) === TRUE) {?>

    <b> <h1 class="text-success">Transaction Successful</h1> </b>
<div class="rr">
    <form action="1.php" method="GET" >
<input type="submit" value="View All Users" class="btn btn-success" id="ddd">
</form>
</div>
<?php
$sql = "SELECT * FROM users WHERE Userid = $id";
$result = $conn->query($sql);
$row=$result->fetch_assoc();
$de =(string) $row["Name"]; 
?> 
<form class="new" action="trans.php">
<input type="submit" value=" View Transactions" class="btn btn-success" id="ddd"></form>
<?php
$sql = "SELECT * FROM users WHERE Userid = $id";
$result = $conn->query($sql);
$row=$result->fetch_assoc();
$de =(string) $row["Name"]; 
$d=date("d-m-y");
$t=date("h:i:sa");
$sql = "INSERT INTO Transactions ( Day,Time,Transferredto, Transferredfrom, Creditstransferred) VALUES ( '".$d."','".$t."','".$ut."', '".$de."', '".$int."')";
session_unset();
// destroy the session
session_destroy();
if($conn -> query($sql)==TRUE){
}
 else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}
else {
    echo "Error in transaction " . $conn->error;
}
?>
</body>
</html>
