<?php

include "dbconnect.php";


if(isset($_POST['submit']))
{
   if($_POST['submit']=="register"){
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $address=$_POST['address'];
        if(IsUserExists($con, $username)){
			header("Location: /bookstore/index.php");
		}
        else{
          CreateUser($con, [$username, $password, $address]);
		  CreateUserCart($con);
          header("Location: /bookstore/index.php");
        }
    }
}

function IsUserExists($con, $username){
	$query="SELECT * FROM users WHERE name = '$username'";
	$result=mysqli_query($con,$query);
	return mysqli_num_rows($result)>0;	
}

function CreateUserCart($con){
	$userID = mysqli_insert_id($con);
	$query ="INSERT INTO cart (userID) VALUES ($userID)";
	mysqli_query($con,$query);
}

function CreateUser($con, array $data){
	$query ="INSERT INTO users (name, password, address) VALUES ('$data[0]','$data[1]', '$data[2]')";
	mysqli_query($con,$query);
}

?>