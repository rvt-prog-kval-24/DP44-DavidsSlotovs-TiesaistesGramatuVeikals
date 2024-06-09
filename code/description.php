<?php
include "vendor/dbconnect.php";
session_start();

$book2_id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$query = "SELECT * FROM products WHERE id='$book2_id'";
$result = mysqli_query($con, $query);
$book2 = mysqli_fetch_assoc($result);

$authorName = GetAuthor($con, $book2['authorID'])['name'];

if(isset($_GET['delete'])){
  $book2Id = $_GET['ID'];
  $query = "DELETE FROM products WHERE id = '$book2Id'";
  mysqli_query($con, $query);
}

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
	<main>
		<div class="container-fluid" id="book2s">
			<div class="row">
				<div class="col-sm-10 col-md-6">
					<div class="tag-side">
					</div>
					<img class="center-block img-responsive" src="../<?= $book2['image']; ?>" height="550px" style="padding:20px;">
				</div>
				<div class="col-sm-10 col-md-4 col-md-offset-1">
					<h2><?= $book2["title"]; ?></h2>
					<span style="color:#00B9F5;"><?= $authorName; ?></span>
					<hr>
					<span style="font-weight:bold;"> Quantity : </span>
					<input type="number" id="quantity" value="1">
					<br><br><br>
					<a id="buyLink" href="/bookstore/cart.php?add=<?= $book2['id']?>" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;">ADD TO CART FOR <?= $book2['price'] ?>&#8364;</a>
					<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1):?>
						<a id="buyLink" href="<?= "/bookstore/vendor/deletebook.php?delete=true&ID=$book2_id"; ?>" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;">Delete</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container-fluid" id="description">
		<?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1):?>
			<form action="/bookstore/vendor/bookEdit.php" method="POST" style="display: flex; flex-direction: column">
				<label for="description2" style="text-align: center; font-size: 24px">Text editor</label>
				<textarea name="description" id="description2" style="height: 500px;"><?= urldecode($book2['description']) ?></textarea>
				<input type="hidden" name="ID" value="<?=basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));?>">
				<button type="submit" style="width: 30%; margin: auto">Save</button>
			</form>
		<?php endif;?>
			<?php if($_SESSION['admin'] == 0):?>
			<div class="row">
					<h2> Description </h2>
					<p><?= urldecode($book2['description']); ?></p>
					<pre style="background:inherit;border:none;">
					PRODUCT CODE <?=$book2["id"]; ?><hr>
					TITLE <?= $book2["title"]; ?><hr>
					AUTHOR <?= $authorName; ?> <hr>
					</div>
			<?php endif;?>
		</div>
	</main>
	<?php include('views/templates/footer.php');?>

<script>
            $(function () {
                var link = $('#buyLink').attr('href');
                $('#buyLink').attr('href', link + '&quantity=' + $('#quantity').val());
                $('#quantity').on('change', function () {
                    $('#buyLink').attr('href', link + '&quantity=' + $('#quantity').val());
                });
            });
    </script>
</body>
</html>       
