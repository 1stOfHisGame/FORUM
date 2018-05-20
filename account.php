<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$a = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
	die("Login to continue");
	return;
}

if(isset($_POST['id'])){
	$a = $_POST['id'];
	$usr_name = "SELECT activity_status FROM users where user_id = '$a'";
	$result = $conn->query($usr_name);
	if($ans = $result->fetch_assoc())
	if($ans['activity_status']=='blocked')
	{
		$usr_name = "UPDATE users SET activity_status='active' where user_id = '$a'";
		$res = $conn->query($usr_name);
	}
	else {
		$usr_name = "UPDATE users SET activity_status='blocked' where user_id = '$a'";
		$res = $conn->query($usr_name);
	}
}

elseif(isset($_POST['eid'])){
	$id=$_POST['eid'];
	
	if(isset($_POST['status']))
	{
	$status=$_POST['status'];
	$usr_name = "UPDATE users SET activity_status='$status' where user_id = '$id'";
	$res = $conn->query($usr_name);
	}
	
	if(isset($_POST['name']))
	{
	$name=$_POST['name'];
	$usr_name = "UPDATE users SET name='$name' where user_id = '$id'";
	$res = $conn->query($usr_name);
	}
	
	if(isset($_POST['role']))
	{
	$role=$_POST['role'];	
	$usr_name = "UPDATE users SET role='$role' where user_id = '$id'";
	$res = $conn->query($usr_name);
	}
	
	if(isset($_POST['mob_no']))
	{
	$mob=$_POST['mob_no'];	
	$usr_name = "UPDATE users SET mob_no='$mob' where user_id = '$id'";
	$res = $conn->query($usr_name);
	}
	
	if(isset($_POST['address']))
	{
	$address=$_POST['address'];	
	$usr_name = "UPDATE users SET address='$address' where user_id = '$id'";
	$res = $conn->query($usr_name);
	}
	
	if(isset($_POST['age']))
	{
	$age=$_POST['age'];	
	$usr_name = "UPDATE users SET age='$age' where user_id = '$id'";
	$res = $conn->query($usr_name);
	}
}

elseif(isset($_POST['newid'])){
	$id=$_POST['newid'];
	$usr_name = 'INSERT INTO users (user_id,name,role,activity_status,address,age,mob_no,pwd) VALUES ("'.$_POST['user_id'].'","'.$_POST['name'].'","'.$_POST['role'].'","'.$_POST['activity_status'].'","'.$_POST['address'].'","'.$_POST['age'].'","'.$_POST['mob_no'].'","'.$_POST['pwd'].'")';
	$res = $conn->query($usr_name);
	header("location:account.php");
}
?>

<html>

        <head><title>Forum - Homepage</title>

        	<link rel="icon" href="hitchhiker_logo.png"></link>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 0;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}


button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
	width: 35%;
	text-align: center;
}

span.psw {
    float: right;
    padding-top: 16px;
}

.entries{
	background-color: #fbfbfb;
    overflow: hidden;
	
	margin: 5px 5px 5px 5px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }


}
.title {
	padding: 2px 2px;
	margin: 5px 5px;
	border-radius: 3%;
	border: 3px solid #555;
	overflow: hidden;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #fbfbfb;
    overflow: hidden;

}

li{
	float:left;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
    background-color: #555;
    color: white;
}

.active{
	background-color: #808080;
    color: white;

}
 </style>       
	</head>

        <body class="homepage-back">

<div class="title"><img src="http://localhost/forum/forum.png" style="width:30%;float:left;"></img><p style="text-align:right">Welcome <a href="account.php">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$a = $_SESSION['user_id'];
if(!isset($a)){
	die("Login to continue");
	return;
}
$usr_name = "SELECT name FROM users where user_id = '$a'";
$result = $conn->query($usr_name); 
$row = $result->fetch_assoc();
	echo $row['name'].'</a><br>';

if($_SESSION['role']=='admin')
echo '<text style="margin: 5px 2px;float:right;background-color:#f0f0f0">ADMIN</text>';
elseif($_SESSION['role']=='manager')
echo '<text style="margin: 5px 2px;float:right;background-color:#f0f0f0">MANAGER</text>';
elseif($_SESSION['role']=='user')
echo '<text style="margin: 5px 2px;float:right;background-color:#f0f0f0">USER</text>';
echo '<a href="http://localhost/forum/logout.php"><input class="button" style="overflow:hidden;margin: 4px 2px;float:right" type="button" value="Logout">
</input></a>';
?>
</p>
  </div>
<div class="title">

<ul>
 <li><a class="active" href="#home">Users</a></li>
  <li><a href="messages.php">Messages</a></li>
  <?php
  if($_SESSION['role']=='admin')
	  echo '<li><a href="createuser.php">Create User</a></li>';
  ?>
  <li style="float:right"><a href="about_us.php">About us</a></li>
</ul>
</div>
<div class="title" style="border-radius:1%;">
<?php
$a=$_SESSION['user_id'];
$result = "SELECT * FROM users";
$result = $conn->query($result);
echo $result->num_rows.' user(s) found<br><hr>';
if(($result->num_rows)!=0){ 
while($row = $result->fetch_assoc()){
	echo '<div class="entries">';
	if($_SESSION['role']=='admin' || $_SESSION['role']=='manager' || $a==$row['user_id'])
	{
		
		echo '<form name="_form" action="http://localhost/forum/profile.php" method="post"><input type="hidden" value="'.$row['user_id'].'" name="eid"></input><input class="button" style="overflow:hidden;margin: 20px 4px;float:right" type="submit" value="Edit Profile"></input></form>';
		if($_SESSION['role']=='admin' || $_SESSION['role']=='manager' ){
		echo '<form name="login_form" action="http://localhost/forum/account.php" method="post"><input type="hidden" value="'.$row['user_id'].'" name="id"></input>';
		if($row['activity_status']=='active')
			echo '<input class="button" style="overflow:hidden;margin: 4px 4px;float:right" type="submit" value="BLOCK"></input>';
		else echo '<input class="button" style="overflow:hidden;margin: 4px 4px;float:right" type="submit" value="UNBLOCK"></input>';
		echo '</form>';
		}
	}
	echo '<h3 style="float:left;margin: 4px">'.$row['name'].'</h3>';
	echo '<text style="margin: 5px 2px;float:left;background-color:#f0f0f0">'.$row['role'].'</text>';
	if($row['activity_status']=='blocked')
		echo '<text style="margin: 5px 2px;float:left;background-color:#ff6666">'.$row['activity_status'].'</text><br><br>';
	else echo '<text style="margin: 5px 2px;float:left;background-color:#80ff80">'.$row['activity_status'].'</text><br><br>';
	echo '<text style="margin: 0px 2px;float:left;"><b>Age:</b> '.$row['age'].'		<b>Mobile no.:</b> '.$row['mob_no'].'</text><br></div>';

}
}
?>
</div>
      </body>

    </html>


