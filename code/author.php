<?php
include "vendor/dbconnect.php";
session_start();
$authorID = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$authorName = GetAuthor($con, $authorID)['name'];

$query = "SELECT * FROM products WHERE authorID='$authorID'";
$result = mysqli_query ($con,$query);
$books3 = mysqli_fetch_all($result);

function GetAuthor($con, $authorID){
	$query = "SELECT * FROM authors WHERE id = $authorID";
	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('views/templates/head.php');?>
<body>
<?php include('views/templates/header.php');?>
    <div id="top" style="margin-top: 150px;">
    <?php
    if(isset($_POST['sort']))
    {
        if($_POST['sort']=="price"){   
            $query = "SELECT * FROM products WHERE authorID='$authorID' ORDER BY price";
            $result = mysqli_query ($con,$query);
            $books3 = mysqli_fetch_all($result);
        }
        else if($_POST['sort']=="priceh"){   
            $query = "SELECT * FROM products WHERE authorID='$authorID' ORDER BY price DESC";
            $result = mysqli_query ($con,$query);
            $books3 = mysqli_fetch_all($result);
        }

    } 
    ?>
    <div class="container-fluid" id="books">
        <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h2 style="color:#D67B22;text-transform:uppercase;margin-bottom:0px;"> <?= $authorName?> STORE </h2>
           </div>
        </div>      
        <div class="container fluid">
             <div class="row">
                  <div class="col-sm-5 col-sm-offset-6 col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8">
                       <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="pull-right">
                           <label for="sort">Sort by &nbsp: &nbsp</label>
                            <select name="sort" onchange="form.submit()">
                                <option value="default" name="default"  selected="selected">Select</option>
                                <option value="price" name="price">Low To High Price </option>
                                <option value="priceh" name="priceh">Highest To Lowest Price </option>
                            </select>
                       </form>
                  </div>
              </div>
        </div>
        <?php
            $i=0;
            foreach($books3 as $book){
                $description="/bookstore/description.php/".$book[0];
                if($i%4==0)
                    echo '<div class="row">';
                echo'
                <a href="'.$description.'">
                    <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                        <div class="book-block" style="border :3px solid #DEEAEE;">
                            <img class="book block-center img-responsive" src="../'.$book[6].'">
                            <hr>
                            ' . $book[1] . '<br>
                            ' . $book[3] .' &#8364
                        </div>
                    </div>
                    
                </a> ';
                $i++;
                if($i%4==0)
                    echo '</div>';
            }
    ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>		