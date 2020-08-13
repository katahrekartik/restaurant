
<?php require 'app/middlewares/checklogin.php' ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="lib/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <title>Food Menu</title>
</head>

<body>
<div class="loader-container" id="loader">
        <div class="loader"></div>

    </div>
    <div class="header">
       <!-- Include nav bar from partials -->
       <?php require 'partials/_nav.php' ?>
        <!-- Navbar ends -->    

    </div>
   


    <div class="container mt-5 menu-list">
    <input type="hidden" id="sessionLoggedin" value="<?php echo $_SESSION['loggedin']?>"/>
        <div class='container food-category mt-5'>
            <h3>Our offered <span id="headingTextData"></span> Menu</h3>
            <h2>Some trendy and Populer <span id="subHeadingData"></span> Food Categories</h2><hr>
        </div>
        <div class="row" id="menuListCategory">
         
        </div>

    </div>



    <!-- Form for otdering the item display here -->

    <!-- Register modal starts here -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <div class="order-form">
                        <div class="alert alert-success">
                        <strong>Success!</strong> Ordered successfully.
                        </div>
                        <div class="alert alert-danger">
                        <ul></ul>
                        </div>
                        <form action="" method="post" id="orderForm">
                            <input type="hidden" id="formFooditemID"/>
                            <input type="hidden" id="formRestaurantID">
                            <input type="hidden" id="customerID" value="<?php echo $_SESSION['user_id'] ?>"/>
                            <input type="hidden" id="sessionUserType" value="<?php echo $_SESSION['user_type'] ?>"/>
                            <div class="form-group">
                                <input type="text" name="item_id" id="itemName" value="" required="required" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Full name" id="fullName" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" name="contact" id="contact" placeholder="Contact number" required="required">
                            </div>
                            <div class="form-group">
                                price
                                <input type="number" name="price" id="price" required="required" readonly>
                            </div>
                            <div class="form-group">Address
                                <textarea name="address" id="address" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="order_item" id="orderItem" class="button">Confirm order</button>
                            </div>
                        </form>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
<!-- Register modal end -->





        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/menuscript.js"></script>
</body>

</html>