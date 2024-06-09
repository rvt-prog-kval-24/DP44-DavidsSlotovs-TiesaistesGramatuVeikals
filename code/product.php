<?php
session_start();
include "vendor/dbconnect.php";

if(isset($_GET['value'])){  
    $_SESSION['category'] = $_GET['value'];
}
$category = $_SESSION['category'];

if(isset($_POST['sort']))
{
    if($_POST['sort']=="price")
            {   $query = "SELECT * FROM products WHERE category='$category' ORDER BY price";
                $result = mysqli_query ($con,$query);
                $books = mysqli_fetch_all($result);
                ?>
                    <script type="text/javascript">
                        document.getElementById('select').Selected=$_POST['sort'];
                    </script>
                <?php
            }
    else
    if($_POST['sort']=="priceh"){   
        $query = "SELECT * FROM products WHERE category='$category' ORDER BY price DESC";
        $result = mysqli_query ($con,$query)or die(mysqli_error($con));
        $books = mysqli_fetch_all($result);
    }

} 
else{   
    $query = "SELECT * FROM products WHERE category='$category'";
    $result = mysqli_query ($con,$query);
    $books = mysqli_fetch_all($result);
} 
$i=0;

?>

<!DOCTYPE html>
<html lang="en">

<?php include('views/templates/head.php');?>
<body>

<?php include('views/templates/header.php');?>
    <div class="container-fluid" id="books" style="margin-top: 120px;">
        <div class="row">
            <div class="col-xs-12 text-center" id="heading">
                <h2 style="color:rgb(228, 55, 25);text-transform:uppercase;margin-bottom:0px;"> <?= $category; ?> BOOKS </h2>
            </div>
        </div>      
        <div class="container fluid">
            <div class="row">
                <div class="col-sm-5 col-sm-offset-6 col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="pull-right">
                        <label for="sort">Sort by &nbsp: &nbsp</label>
                        <select name="sort" id="select" onchange="form.submit()">
                            <option value="default" name="default"  selected="selected">Select</option>
                            <option value="price" name="price">Low To High Price </option>
                            <option value="priceh" name="priceh">Highest To Lowest Price </option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    <?php 
        foreach($books as $book){
        $description="description.php/".$book[0];
        if($i%4==0)
        echo '<div class="row">';
        echo'
            <a href="'.$description.'">
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="book-block" style="border :3px solid #DEEAEE;">
                    <img class="book block-center img-responsive" src="'.$book[6].'">
                    <hr>
                        ' . $book[1] . '<br>
                    ' . $book[3] .' &#8364;
                </div>
            </div>
            
            </a> ';
        $i++;
        if($i%4==0)
        echo '</div>';
        }
    echo '</div>';
    ?>
</body>
</html>	

