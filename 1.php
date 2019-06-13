<!DOCTYPE html>
<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$errors = array();
	
if (empty($_POST["un"])) {
		$errors['name'] = 'Please Select an user';
	} else {
		$name = filter_var($_POST['un'], FILTER_SANITIZE_STRING);
	}
        
        $_SESSION = $_POST;
        session_write_close();
	
	if ($name) { 
header("location: 2.php ");
exit ();	
}

}?>
<html>
<head>
<title>
All Users
</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<style>
table, th, td {
  border: 1px solid black;
margin:auto;
width:17%;
text-align:center;
margin-bottom:20px;
}
.ssd{
margin:auto;
width:17%;
text-align:center;
margin-bottom:20px;}
h1 {
margin-top:40px;
text-align:center;
color: rgb(0,0,0);
font-size:40px;
 font-family: "Times New Roman", Times, serif;
}
.warning{
color:red;
position:absolute;
right:450px;

}
.a{
margin-left:340px;
}
.fot b{
color:rgba(255, 0, 0, 0.8);
}
.fot{
margin:auto;
width:25%;
border-style: solid;
  border-width: 1px;
text-align:center;
}
.rav{
dispaly:none;
}
</style>
<body>
<b> <h1>List Of Users</h1> </b>
<br/>

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
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if($result->num_rows>0)
{?>
<div class="ssd">
<table class="table table-bordered">
<tr>
<th>
sno.
</th>
<th>
Name
</th>
<th>
Creditsavailable
</th>
</tr> 
<?php
$i=0;
 while($row=$result->fetch_assoc()) {
$i=$i+1;
?>
<tr>
<td>
<b> <?php echo $i ?> </b>
</td>
<td>
<i<b><?php echo $row["Name"]; ?></i>
</td>
<td>
<?php echo $row["Creditsavailable"];?>
</td>
</tr>
<?php } ?>
</table>
</div>
<?php }
else
{
echo "no";
}
?>
<br/>
<br/>
<div class="a" ng-app="">
<form action="" method="post">
Enter the name of user name from whom you want to transfer credit:
<select name="un">
    <option value="">--</option>
<?php
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$num=$result->num_rows;
while($row=$result->fetch_assoc()) { $k="Yegna"?>
<p class="rav" ng-model="val"><?php echo $row["Name"]?></p>
    <option value="<?php echo $row["Name"]?>"><?php echo $row["Name"]?></option><?php } ?>
  </select>

<p class="warning"><?php if (isset($errors['name'])) echo $errors['name']; ?> </p>
<input type="submit" value="submit" class="btn btn-success">
</form>
</br>
</div>
<div class="fot">
<p><b>Note!</b>Usernames are case-sensitive</p>
</div>
</body>
</html>

