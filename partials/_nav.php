<!-- Navigation bar starts here -->
<nav class="navbar navbar-expand-lg sticky-top navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="index.php">Food<span class="logo-design">Shala</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link custom-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php

                session_start();
                if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true ){
                   echo '
                   <li class="nav-item">
                        <a class="nav-link custom-link" href="#" data-toggle="modal" data-target="#loginModal" id="loginButton">Login</a>
                    </li>
                    </ul>
                    <a type="button" id="signupbtn" data-toggle="modal" data-target="#registerModal">Sign up</a>
                   ';
                }else{
                    if($_SESSION['user_type']=='restaurant'){
                        echo '
                        <li class="nav-item">
                            <a class="nav-link custom-link" href="dashboard.php">Dashboard</a>
                        </li>
                        </ul>
                        ';
                    } 
                    echo '
                    <a href="logout.php" type="button" id="signupbtn">Logout</a>
                    ';
                }
                ?>
                
        </div>
    </div>
</nav>
<!-- End navigation bar -->



    <!-- Login modal starts here -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <ul></ul>
                    </div>
                    <div class="login-form">
                        <!-- <form action="app/controllers/Users.php" method="post"> -->
                        <form action="" method="post" id="loginForm">
                            <label class="radio-container" style="color:#000">Customer
                                <input type="radio" checked="checked" name="user_type"  value="customer">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-container" style="color:#000">Restaurant
                                <input type="radio" name="user_type"   value="restaurant">
                                <span class="checkmark"></span>
                            </label>
                            <div class="form-group">
                                <input type="text" name="username" id="loginUsername" placeholder="Username" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="loginPassword" placeholder="Password" required="required">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="login" id="login" class="button">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hint-text">New user? <a href="register.php" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Create an account</a></div>
                </div>
            </div>
        </div>
    </div>
<!-- login modal end -->


<!-- Register modal starts here -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Signup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <div class="signup-form">
                        <div class="alert alert-success">
                        <strong>Success!</strong> Registerd successfully.<span><a href="" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"> Login </a> to your account</span>
                        </div>
                        <div class="alert alert-danger">
                        <ul></ul>
                        </div>
                        <form action="" method="post" id="signupForm">
                            <label class="radio-container" style="color:#000">Customer
                                <input type="radio" checked="checked" name="user_type" id="customer" value="customer">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-container" style="color:#000">Restaurant
                                <input type="radio" name="user_type" id="restaurant"  value="restaurant">
                                <span class="checkmark"></span>
                            </label>
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Email" id="email" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" name="restaurant_name" placeholder="Restaurant Name" id="restaurantName" required="required">
                            </div>
                            <div class="form-group">
                                <textarea name="resraurant_address" placeholder="Restaurant Address" id="restaurantAddress" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" id="username" placeholder="Username" required="required">
                            </div>
                            <div class="form-group">
                                <select class="input" name="food_type" id="food_type">
                                    <option value="1">Veg</option>
                                    <option value="2">Non-veg</option>
                                    <option value="3">Both</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="signup" id="signup" class="button">Create account</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hint-text">Already have an account? <a href="" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login</a></div>

                </div>
            </div>
        </div>
    </div>
<!-- Register modal end -->