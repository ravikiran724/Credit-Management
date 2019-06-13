<html>
<head>
<title>
Transactions</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
table, th, td {
  border: 1px solid black;
margin:auto;
width:17%;
text-align:center;
margin-bottom:20px;
}
h1{
font-size:28px;
text-align:center;
margin-top:20px;
margin-bottom:20px;
}
.new{
position:absolute;
top:20px;
right:20px;}
</style>
</head>
<body>
<b> <h1>Transaction List</h1> </b>
<?php
$servername = "localhost";
$username = "id9890111_root";
$password = "test1";
$database="id9890111_db";
$conn=new mysqli($servername,$username,$password,$database);
if ($conn->connect_error) {
	echo "kkk";
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM Transactions";
$result = $conn->query($sql);
$num=$result->num_rows;?>
<table class="table table-bordered">
<tr>
<th>
Transaction Date</th>
<th>
Transaction Time</th>
<th>
Transaction Id</th>
<th>
Debited From</th>
<th>
Credited To</th>
<th>
Credits Transferred</th>
</tr>
<?php while($row=$result->fetch_assoc()) {?>
<tr>
<td>
 <?php
echo $row["Day"] ;
?> </td>
<td>
 <?php
echo  $row["Time"];
?> </td>
<td>
<?php echo $row["tid"];?>
</td>
<td>
<?php echo $row["Transferredfrom"]; ?>
</td>
<td>
<?php echo $row["Transferredto"]; ?>
</td>
<td>
<?php echo $row["Creditstransferred"]; ?>
</td>
</tr>
<?php } ?>
</table>
<form class="new" action="index.html">
<input type="submit" value="Go To Home page" class="btn btn-success"></form>
</body>
</html>

