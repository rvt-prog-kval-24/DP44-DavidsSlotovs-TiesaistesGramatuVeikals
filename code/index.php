<?php
const BOOK_LIMIT = 4;
session_start();
include "vendor/dbconnect.php";

$query = "SELECT * FROM products";
$result = mysqli_query($con, $query);
$books = mysqli_fetch_all($result);

$query = "SELECT * FROM authors";
$result = mysqli_query($con, $query);
$authors = mysqli_fetch_all($result);
?>


<!DOCTYPE html>
<html lang="en">
<?php include('views/templates/head.php');?>
<body>
    <?php include('views/templates/header.php');?>
    <main>
        <div id="top">
            <div class="container-fluid" id="header">
                <div class="row">
                    <div class="col-md-3 col-lg-3" id="category">
                        <div style="background:#426940;color:#fff;font-weight:800;border:none;padding:15px;"> Book Categories </div>
                        <ul>
                            <li> <a href="Product.php?value=entrance%20exam"> Entrance Exam </a> </li>
                            <li> <a href="Product.php?value=Literature%20and%20Fiction"> Literature & Fiction </a> </li>
                            <li> <a href="Product.php?value=Academic%20and%20Professional"> Academic & Professional </a> </li>
                            <li> <a href="Product.php?value=Biographies%20and%20Auto%20Biographies"> Biographies & Auto Biographies </a> </li>
                            <li> <a href="Product.php?value=Children%20and%20Teens"> Children & Teens </a> </li>
                            <li> <a href="Product.php?value=Regional%20Books"> Regional Books </a> </li>
                            <li> <a href="Product.php?value=Business%20and%20Management"> Business & Management </a> </li>
                            <li> <a href="Product.php?value=Health%20and%20Cooking"> Health and Cooking </a> </li>

                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                                <li data-target="#myCarousel" data-slide-to="4"></li>
                                <li data-target="#myCarousel" data-slide-to="5"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img class="img-responsive" src="assets/img/carousel/1.jpg">
                                </div>

                                <div class="item">
                                    <img class="img-responsive"src="assets/img/carousel/2.jpg">
                                </div>

                                <div class="item">
                                    <img class="img-responsive" src="assets/img/carousel/3.jpg">
                                </div>

                                <div class="item">
                                    <img class="img-responsive" src="assets/img/carousel/4.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3" id="offer">
                        <img class="img-responsive center-block" src="assets/img/offers/1.png">
                        <img class="img-responsive center-block" src="assets/img/offers/2.png">
                        <img class="img-responsive center-block" src="assets/img/offers/3.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid text-center" id="new">
            <div class="row">
                <?php for($i = 0; $i < count($books) && $i < BOOK_LIMIT; $i++):?>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <a href="description.php/<?= $books[$i][0]?>">
                            <div class="book-block">
                                <div class="tag">New</div>
                                <img class="book block-center img-responsive" src="<?= $books[$i][6]?>">
                                <hr>
                                <?= $books[$i][1]?> <br>
                                <?= $books[$i][3]?> 	&#8364;
                            </div>
                        </a>
                    </div>
                <?php endfor;?>
            </div>
        </div>

        <div class="container-fluid" id="author">
            <h3 style="color:#D67B22;"> AUTHORS WE CHOOSE </h3>
            <div class="row">
                <?php for($i = 0; $i < count($authors); $i++):?>
                    <div class="col-sm-5 col-md-3 col-lg-3">
                        <a href="author.php/<?= $authors[$i][0]?>"><img class="img-responsive center-block" src="<?=$authors[$i][2]?>"></a>
                    </div>
                <?php endfor?>
            </div>
        </div>
    </main>
    
    <?php include('views/templates/footer.php');?>
    <script src="js/bootstrap.min.js"></script>
        <script>
            $('#register').on("submit", function(event){
                var password = $('input[name=register_password]').val();
                var repeatPassword = $('input[name=password_repeat]').val();
                
                if(password != repeatPassword)
                {
                    $('input[name=password_repeat]').css("border-color", "red");
                    event.preventDefault();  
                }
            })
    </script>
</body>
</html>	