<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$errors = array();
if(empty($_POST["un"])) {
$errors['nam']='Please select user to transfer';
} 
else {
$nam= filter_var($_POST['un'], FILTER_SANITIZE_STRING);
}

if (empty($_POST["cd"])) {

		$errors['val'] = 'Please Enter Credits';
	}
else{
$avl=(is_numeric($_POST["cd"]) ? (int)$_POST["cd"] : 3);
$max=(is_numeric($_POST["cdd"]) ? (int)$_POST["cdd"] : 1);
if($avl>$max){
$errors['val']='Insufficient Credits';
}
else
{
$val = filter_var($_POST['cd'], FILTER_SANITIZE_STRING);
	}
}
        
      
       
	
	if ($val && $nam) { 
  $_SESSION = $_POST;
header("location: 3.php ");
exit ();
echo "suc";	
}
}?>
<!DOCTYPE html>
<html>
<head>
<title>
Transaction page
</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
h1{
text-align:center;
}
.hid
{display:none;
}
#ff{
margin:auto;
width:27%;
}
table, th, td {
  border: 1px solid black;
margin:auto;
width:17%;
text-align:center;
margin-bottom:20px;
}
#b{
display:none;
}
#a{
display:none;
}
.err{
color:red;
}
</style>
</head>
<body>
<b><h1>View User </h1></b>
<?php
$_POST=$_SESSION;
$servername = "localhost";
$username = "id9890111_root";
$password = "test1";
$database="id9890111_db";
$conn=new mysqli($servername,$username,$password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$usrn=(string) $_POST["un"];
if (empty($_POST["un"])) {
    $usErr = "Field is empty";
}
else
{

$sql = "SELECT * FROM users WHERE Name='" .$usrn. "'";
$result = $conn->query($sql);
if($result->num_rows>0)
{
?>
 <table class="table table-bordered">
	<tr>
		<th>
		 Name
</th>
	<th>
		Email
</th>
	<th>
		Credits Available
</th>
	<th>
		Phone Number
</th>
</tr>
<?php $row = $result->fetch_assoc(); 
$_SESSION['c'] = (is_numeric($row["Userid"]) ? (int)$row["Userid"] : 0);?>
<tr>
<td>
<?php echo $row["Name"]; ?>
</td>
<td>
<?php echo $row["Email"]; ?>
</td>
<td>
<?php echo $row["Creditsavailable"]; ?>
</td>
<td>
<?php echo $row["phn"]; ?>
</td>
</table>
<div id="ff">
<p> Maximum credits available to transfer <?php echo ":".$row["Creditsavailable"]; ?> </p>
<div id="d">
<br/>
<input type="button" onclick="document.getElementById('a').style.display='block';document.getElementById('d').style.display='none'" value="Transfer Credits" class="btn btn-success"></div>
<div id="a">
<form action="" method="post">
Enter the amount of credit you want to transfer:
<input type="text" name="cdd" value="<?php echo $row["Creditsavailable"]?>" class="hid">
<input type="text" name="cddd" value="<?php echo $row["Userid"]?>" class="hid">
<input type="text" name="cd">
<span class="err">*<?php if (isset($errors['val'])) echo $errors['val'];?></span>
<div id="b">
<br/>
Enter the Name of user to whom you want to transfer:  
<select name="un">
    <option value="">--</option>
<?php
$sql = "SELECT * FROM users WHERE Name!='" .$usrn. "'";
$result = $conn->query($sql);
$num=$result->num_rows;
while($row=$result->fetch_assoc()) { ?>
    <option value="<?php echo $row["Name"]?>"><?php echo $row["Name"]?></option><?php } ?>
  </select>
<span class="err">*<?php if (isset($errors['nam'])) echo $errors['nam'];?></span>
<br/>
<br/>
<input type="submit" value="Transfer" class="btn btn-success">

</div>
<div id="c">
<br/>
<input type="button" class="btn btn-success" onclick="document.getElementById('b').style.display='block';document.getElementById('c').style.display='none'" value="Select User"></div>
</form>
</div>
</div>
<?php } 
else
{
echo "ffe";
echo "no";
$usErr="User name Not Found";
}
}?>
</body>
</html>
