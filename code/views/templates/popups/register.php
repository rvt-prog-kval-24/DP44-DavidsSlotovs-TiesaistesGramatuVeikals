<li>
    <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign Up</button>
    <div id="register" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: green; color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Member Registration Form</h4>
                </div>
                <div class="modal-body">
                            <form class="form" role="form" method="post" action="/bookstore/vendor/register.php" accept-charset="UTF-8">
                                <div class="form-group">
                                    <label class="sr-only" for="username">Username</label>
                                    <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" name="password_repeat" class="form-control"  placeholder="Repeat your password" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="address">Address</label>
                                    <input type="text" name="address" class="form-control"  placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" value="register" class="btn btn-block" style="background-color: green; color: white;">
                                        Sign Up
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