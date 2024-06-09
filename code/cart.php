<?php
	include "vendor/dbconnect.php";
	session_start();

    $customer= $_SESSION['user'];
    $userID = $customer['id'];
    $userCart = GetUsersCart($con, $userID);


    if(isset($_GET['add'])){
        $productID = $_GET['add'];
        $cartID = $userCart['id'];
        $quantity = $_GET['quantity'];
        $query="INSERT INTO cartItems (productID, cartID, quantity) VALUES ($productID, $cartID, $quantity)";
        mysqli_query($con,$query);
    }

    if(isset($_GET['place'])){  
        $query = "INSERT INTO orders (userID) VALUES ($userID)";
        mysqli_query($con, $query);
        $orderID = mysqli_insert_id($con);
        $cartID = $userCart['id'];

        $query = "
        INSERT INTO orderItems (orderID, productID, quantity)
        SELECT $orderID, productID, quantity
        FROM cartItems
        WHERE cartID = $cartID";

        mysqli_query($con, $query);

        
        $query="DELETE FROM cartItems WHERE cartID=$cartID";
        mysqli_query($con,$query);
        
        echo
        '<script type="text/javascript">
                alert("Order SuccessFully Placed!! Kindly Keep the cash Ready. It will be collected on Delivery");
        </script>';         
    }

    if(isset($_GET['remove'])){  
        $cartItem=$_GET['remove'];
        $userCartID = $userCart['id'];
        $query="DELETE FROM cartItems WHERE cartID=$userCartID AND productID= $cartItem ";
        $result=mysqli_query($con,$query);
        echo '<script type="text/javascript">
                alert("Item Successfully Removed");
        </script>';
    }     

    function GetUsersCart($con, $userID){
        $query = "SELECT * FROM cart WHERE userID = $userID";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_assoc($result);
    }
    function GetAuthorNameByID($con, $authorID){
        $query = "SELECT name FROM authors WHERE id = $authorID";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include('views/templates/head.php');?>
<style>
    #cart {margin-top:30px;margin-bottom:30px;}
    .panel {border:1px solid #D67B22;padding-left:0px;padding-right:0px;}
    .panel-heading {background:#D67B22 !important;color:white !important;}        
    @media only screen and (width: 767px) { body{margin-top:150px;}}
</style>
<body>
<?php include('views/templates/header.php');?>
    <div class="container-fluid" id="cart" style="margin-top: 150px">
        <div class="row">
            <div class="col-xs-12 text-center" id="heading">
                <h2 style="color:#D67B22;text-transform:uppercase;">Your cart</h2>
            </div>
        </div>
    <?php
	if(isset($_SESSION['user'])){   
            if(isset($_GET['ID'])){   
                $product=$_GET['ID'];
                $quantity=$_GET['quantity'];
                $query="SELECT * FROM cart Where userID='$userID' AND product='$product'";
                $result=mysqli_query($con,$query);
                $row = mysqli_fetch_assoc($result);
                if(mysqli_num_rows($result)==0){ 
                    $query="INSERT INTO cart values('$customer','$product','$quantity')"; 
                    $result=mysqli_query($con,$query);
                }
                else{ 
                    $new=$_GET['quantity'];
                    $query="UPDATE `cart` SET Quantity=$new WHERE Customer='$customer' AND product='$product'";
                    $result=mysqli_query($con,$query);
                }
            }
            $cartID = $userCart['id'];
            $query="SELECT * FROM cartItems INNER JOIN products ON cartItems.productID=products.id 
                    WHERE cartID=$cartID";
            $result=mysqli_query($con,$query); 
            $total=0;
            if(mysqli_num_rows($result)>0){    
                $i=1;
                $j=0;                
                while($row = mysqli_fetch_assoc($result))
                {       
                $path = $row['image'];
                $Stotal = $row['quantity'] * $row['price'];
                if($i % 2 == 1)  $offset= 1;
                if($i % 2 == 0)  $offset= 2;                                                
                if($j%2==0)
                                 echo '<div class="row">'; 
                                 echo '                
                                      <div class="panel col-xs-12 col-sm-4 col-sm-offset-'.$offset.' col-md-4 col-md-offset-'.$offset.' col-lg-4 col-lg-offset-'.$offset.' text-center" style="color:#D67B22;font-weight:800;">
                                          <div class="panel-heading">Order '. $i .'
                                          </div>
                                          <div class="panel-body">
			                                                <img class="image-responsive block-center" src="'.$path.'" style="height :100px;"> <br>
           							                                               		Title : '.$row['title'].'<br> 
                                                                        				Code : '.$row['id'].'<br>        	 
                                                      									Author : '.GetAuthorNameByID($con, $row['authorID'])['name'].' <br>                            	      
                                                      									Quantity : '.$row['quantity'].'<br>
                                                      									Price : '.$row['price'].'	&#8364; <br>
                                                      									Sub Total : '.$Stotal.'	&#8364; <br>
                                                                       <a href="cart.php?remove='.$row['id'].'" class="btn btn-sm" 
                                                                          style="background:#D67B22;color:white;font-weight:800;">
                                                                          Remove
                                                                        </a>
                                        </div>
                                    </div>';
                               if($j % 2==1)
                                   echo '</div>';                                 
                               $total=$total + $Stotal; 
                               $i++;
                               $j++;                                                 
                     } 
                    
                    echo '<div class="container">
                              <div class="row">  
                                 <div class="panel col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 text-center" style="color:#D67B22;font-weight:800;">
                                     <div class="panel-heading">TOTAL
                                     </div>
                                      <div class="panel-body">'.$total.' &#8364;
                                     </div>
                                 </div>
                               </div>
                          </div>
                         ';
                     echo '<br> <br>';
                     echo '<div class="row">
                             <div class="col-xs-8 col-xs-offset-2  col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3">
                                  <a href="index.php" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;">Continue Shopping</a>
                             </div>
                             <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-1 col-lg-4 ">
                                  <a href="cart.php?place=true" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;margin-top:5px;">Place Order</a>
                             </div>
                           </div>
                           ';
                } 
               else{  
                    echo ' 
                        <div class="row">
                        <div class="col-xs-9 col-xs-offset-3 col-sm-4 col-sm-offset-5 col-md-4 col-md-offset-5">
                                <span class="text-center" style="color:#D67B22;font-weight:bold;">Is Empty</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-9 col-xs-offset-3 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
                                <a href="index.php" class="btn btn-lg text-center" style="background:#D67B22;color:white;font-weight:800;">Do Some Shopping</a>
                            </div>
                        </div>';
                }               
	    }
    ?>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
<html>		