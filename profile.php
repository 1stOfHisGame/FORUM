<?php
session_start();
?>

<html>

        <head><title>Forum - Homepage</title>

        	<link rel="icon" href="hitchhiker_logo.png"></link>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 0;}

input[type=text], input[type=password],input[type=number] {
    width: 60%;
    padding: 3px 5px;
    margin: 5px 5px 5px 5px;
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

<div class="title"><img src="http://localhost/forum/forum.png" style="width:30%;float:left;"></img><p style="text-align:right">Welcome <a href="profile.php">
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
$edit_id = $_POST['eid'];
echo '<h2>Edit User Profile</h2><hr>';
$usr_name = "SELECT * FROM users where user_id = '$edit_id'";
$result = $conn->query($usr_name); 
$row = $result->fetch_assoc();
echo '<form name="lo_form" action="http://localhost/forum/account.php" method="post">
<input type="hidden" value="'.$edit_id.'" name="eid"></input>
					<b>Name</b>
                    <input  type="text"  value="'.$row['name'].'" name="name"></input><br>
					<b>Password</b>
                    <input  type="password"  value="'.$row['pwd'].'" name="pwd" maxlength="20" minlength="3"></input><br>';
					if($_SESSION['role']=='admin'){
					echo '<br><b>Role</b>
					<input type="radio" name="role" value="admin" ';if($row['role']=='admin') echo 'checked';echo '> Admin
					<input type="radio" name="role" value="manager" '; if($row['role']=='manager') echo 'checked';echo '> Manager
					<input type="radio" name="role" value="user" '; if($row['role']=='user') echo 'checked';echo '> User <br><br> <b>Status</b>
					<input type="radio" name="status" value="active" '; if($row['activity_status']=='active') echo 'checked';echo'> Active 
					<input type="radio" name="status" value="blocked" '; if($row['activity_status']=='blocked') echo 'checked';echo'> Blocked <br>';
					}
					echo '<br><b>Address</b>
					<input  type="text" value="'.$row['address'].'" name="address"></input><br>
					<b>Age</b>
					<input  type="number"  value="'.$row['age'].'" name="age"></input><br>
					<b>Mobile no.</b>
					<input  type="number" value="'.$row['mob_no'].'" name="mob_no"></input><br><br>
					<input style="margin-right:10px;" class="button" type="submit" value="Save Changes"></input>
					<a href="http://localhost/forum/account.php"><input style="margin-right:10px;" type="button" value="Discard Changes"></input></a></form>';



?>
</div>
      </body>

    </html>


