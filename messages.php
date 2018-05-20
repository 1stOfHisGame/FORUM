<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
date_default_timezone_set('Asia/Kolkata');
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

if(isset($_POST['del'])){
	$q = 'DELETE FROM messages WHERE msg_id ="'.$_POST['did'].'"';
	if($conn->query($q)==true)
		echo '<h3>Message successfully deleted</h3>';
	header("location:messages.php");
}

elseif(isset($_POST['post']) && isset($_POST['message'])){
    $usr_name = 'INSERT INTO messages (user_id,msg,date_time,msg_id) VALUES ("'.$_SESSION['user_id'].'","'.$_POST['message'].'","'.date("Y-m-d h:i:sa").'","NULL")';
	$res = $conn->query($usr_name);	
	header("location:messages.php");
}
?>

<html>

        <head><title>Forum - Messages</title>

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
	background-color: #f0f0f0;
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
 <li><a href="account.php">Users</a></li>
  <li><a class="active" href="messages.php">Messages</a></li>
  <?php
  if($_SESSION['role']=='admin')
	  echo '<li><a href="createuser.php">Create User</a></li>';
  ?>
  <li style="float:right"><a href="about_us.php">About us</a></li>
</ul>
</div>
<div class="title" style="border-radius:1%;height:50%;overflow:auto;">
<?php
$a=$_SESSION['user_id'];
$result = "SELECT * FROM messages";
$result = $conn->query($result);
echo $result->num_rows.' message(s) found<br><hr>';
if(($result->num_rows)!=0){ 
while($row = $result->fetch_assoc()){
	$res = 'SELECT * FROM users where user_id="'.$row['user_id'].'"';
	$res = $conn->query($res);
	if($row1 = $res->fetch_assoc())
	{
		echo '<div class="entries">';
	if($_SESSION['role']=='admin' || $a==$row['user_id'])
	{
		echo '<form name="_form" action="http://localhost/forum/messages.php" method="post"><input type="hidden" value="'.$row['msg_id'].'" name="did"></input><input class="button" style="overflow:hidden;margin: 20px 4px;float:right" type="submit" name="del" value="Delete"></input></form>';
	}
	echo '<h3 style="float:left;margin: 4px">'.$row1['name'].'</h3>';
	echo '<text style="margin: 5px 2px;float:left;background-color:#fbfbfb">'.$row1['role'].'</text>';
	echo '<text style="margin: 5px 2px;float:left;background-color:#ddffcc"> '.$row['date_time'].'</text><br><br>';
	if($row1['activity_status']=='active')
		echo '<img src="http://localhost/forum/apostrophe2.png" style="float:left;height:8px;width:8px;"><div style="float:left;margin: 3px;background-color:#ffffb3">'.$row['msg'].'</div><img src="http://localhost/forum/apostrophe1.png" style="height:8px;width:8px;"><br>';
	else echo '<text style="margin: 7px;float:left;background-color:#ffb3b3">This user is blocked. Contact admin to view message.</text><br><br>';
	echo '</div>';
	}
}
}
echo '</div><div class="title" style="border: none">
	<form name="msg" action="http://localhost/forum/messages.php" method="post">
	<input style="width: 99%;align:center;margin: 7px 7px 7px 7px;"type="text" placeholder="Type new message here..." name="message" maxlength="1000"><br></input>
	<input type="submit" style="margin: 0px 7px;float:right;" name="post" value="Post"></input>
	<input type="hidden" value='.date("Y-m-d h:i:sa").' name="date_time"></input>
	</form></div>';
?>
      </body>

    </html>


