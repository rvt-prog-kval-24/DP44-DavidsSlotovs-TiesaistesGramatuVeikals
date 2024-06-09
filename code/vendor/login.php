<?php
include "dbconnect.php";

session_start();

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
	$username=$_POST['login_username'];
	$password=$_POST['login_password'];
	$query = "SELECT * FROM users WHERE name ='$username' AND password='$password'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$_SESSION['user']['id']=$row['id'];
		$_SESSION['user']['name']=$row['name'];
		$_SESSION['admin'] = $row['isAdmin'];
		header("Location: /bookstore/index.php");
	}
	else
		echo "<script>
			alert('Wrong usernamer or password');
		</script>";
   	}
}
?>	
