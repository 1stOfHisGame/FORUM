<?php
session_start();
?>

<html>

        <head><title>Forum - About Us</title>

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
<text"><br><br><center>Developed by <b>Rushabh Mishra</b><br>
Email ID: <b>rushabh.mishra@gmail.com</b></center></text>
</div>
      </body>

    </html>


