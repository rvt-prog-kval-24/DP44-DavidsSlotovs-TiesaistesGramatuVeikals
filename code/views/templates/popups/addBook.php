<?php

    $query = "SELECT * FROM authors"; 
    $result = mysqli_query($con, $query);
    $authors = mysqli_fetch_all($result);

    $query = "SELECT COLUMN_TYPE 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_NAME = 'products' 
        AND COLUMN_NAME = 'category'";
    $result = mysqli_query($con, $query);
    $categories = mysqli_fetch_all($result);
    preg_match_all("/'([^']+)'/", $categories[0][0], $matches);
    $categories = $matches[1];
?>

<li>
    <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#register">Add Book</button>
    <div id="register" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: green; color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Adding new book</h4>
                </div>
                <div class="modal-body">
                    <form class="form" role="form" method="post" action="/bookstore/vendor/addBook.php" accept-charset="UTF-8"  enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="sr-only" for="password">Book title</label>
                            <input type="text" name="title" class="form-control"  placeholder="Book Title" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Author</label>
                            <select name="author" class="form-control">
                                <option selected disabled>Book author</option>
                                <?php foreach($authors as $author):?>
                                    <option value="<?= $author[0]?>"><?= $author[1]?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="address">Description</label>
                            <select name="category" class="form-control">
                                <option selected disabled>Category</option>
                                <?php for($i = 0; $i < count($categories); $i++):?>
                                    <option value="<?= $categories[$i]?>"><?= $categories[$i]?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="address">Description</label>
                            <textarea name="description" placeholder="Description" style="width: 100%; min-height:200px; resize: none;" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input id="inputImage" type="file" name="image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="username" class="form-control">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="register" class="btn btn-block" style="background-color: green; color: white;">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: green; color: white;">Close</button>
                </div>
            </div>
        </div>
    </div>
</li>