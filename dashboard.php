<?php require 'app/middlewares/checklogin.php' ?>
<?php require 'app/middlewares/m_dashboard.php' ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="header">
       <!-- Include nav bar from partials -->
       <?php require 'partials/_nav.php' ?>
        <!-- Navbar ends -->    

    </div>

    <div class="container-fluid dashboard">
        <div class="row content">
            <div class="col-md-2 sidenav">
                <div class="sidebar">
                    <h3><?php echo $_SESSION['restaurant_name'] ?></h3>
                    <input type="hidden" id="restaurantID" value=<?php echo $_SESSION['restaurant_id'] ?>>
                    <h4>Dashboard</h4>
                    <ul class="">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="#dashboard-menu-list">Menu</a></li>
                        <li><a href="#dashboard-order-list">Orders</a></li>
                    </ul><br>
                </div>

            </div>

            <div class="col-md-10">
                <div class="dashboard-content mt-5">
                    <div class="dashboard-menu-list-header">
                        <div class="dashboard-menu-list-header-text">
                            <h2>Welcome to <?php echo $_SESSION['restaurant_name'] ?>!</h2>
                            <p>Your all menu items and orders details</p>
                        </div>
                        <div class="dashboard-menu-list-button">
                            <button class="button" data-toggle="modal" data-target="#additemModal">+ Add Item</button>
                        </div>
                        <hr>
                    </div>
                    <div class="dashboard-menu-list" id="dashboard-menu-list">
                        <h1>Menu Items</h1>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Food type</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <!-- Display dashboard food items here -->
                                <tbody id="dashboardAllFooditem">
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="dashboard-order-list" id="dashboard-order-list">
                        <h1>Orders</h1>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item Name</th>
                                        <th>Customer Name</th>
                                        <th>Price</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <!-- Display dashboard Orders list here -->
                                <tbody id="ordersList">
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add items Modal -->

        <div class="modal fade" id="additemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="alert alert-success">
                            <strong>Success!</strong> Item added successfully.
                            </div>
                            <div class="alert alert-danger">
                            
                            </div>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="file" name="item_image" id="itemImage" placeholder="Upload image" readonly>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="item_name" id="itemName" placeholder="Item name" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="item_price" id="itemPrice" placeholder="Item Price" required>
                                </div>

                                <div class="form-group">
                                    <select class="input" name=""  id="foodCategory" required>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="input" name="" id="foodType" required>
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="item_description" id="itemDescription" cols="30" rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="addItem" id="addItem" class="button">Add item</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/dashboardscript.js"></script>
</body>

</html>