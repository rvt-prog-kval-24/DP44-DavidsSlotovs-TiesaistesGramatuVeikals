<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/bookstore/index.php" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="<?=SCRIPT_ROOT?>/assets/img/logo.png"  style="width: 268px;margin-top: -35px;"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(!isset($_SESSION['user'])):?>
                    <?php include("popups/login.php");?>
                    <?php include("popups/register.php");?>
                <?php else: ?>
                    <li> <a href="#" class="btn btn-lg">Welcome, <?=$_SESSION['user']['name']?></a></li>
                    <li> <a href="/bookstore/cart.php" class="btn btn-lg"> Cart </a> </li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1):?>
                        <?php include("popups/addBook.php");?>
                        <?php include("popups/orders.php");?>
                    <?php endif;?>
                    <li> <a href="/bookstore/destroy.php" class="btn btn-lg"> LogOut </a> </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
    <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
        <div>
            <form role="search" method="POST" action="Result.php">
                <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Book Or Category">
            </form>
        </div>
    </div>
</nav>