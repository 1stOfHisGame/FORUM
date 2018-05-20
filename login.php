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

$user_id = $_POST["user_id"];
$pass = $_POST["pwd"];

$sql = "SELECT user_id FROM users where user_id = '$user_id'";
$sql = $conn->query($sql);
if ($sql->num_rows == 0){
	echo "The User ID '" . $_POST['user_id'] ."' is not registered<br>Contact administrator to resolve the issue.";
	return;
}
$sql = "SELECT user_id, role,activity_status FROM users where (user_id = '$user_id' AND pwd = '$pass')";
$sql = $conn->query($sql);
if ($sql->num_rows == 1) {
	while($temp = $sql->fetch_assoc()){
		$_SESSION['user_id'] = $temp['user_id'];
		$_SESSION['role'] = $temp['role'];
		$status = $temp['activity_status'];
	}
	if($status=='blocked')
			echo 'You have been blocked. Contact admin to get unblocked.';
	else header("location:account.php");
} else {
	echo "Incorrect user id or password<br>Please go back and login from correct credentials :)";
}

$conn->close();
?>