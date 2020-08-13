<?php require 'app/middlewares/checklogin.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
    <title>FoodShala</title>
</head>
<body>

<!-- Header with Navigation bar starts here  -->
    <div class="header">
        <!-- Include nav bar from partials -->
        <?php require 'partials/_nav.php' ?>
        <!-- Navbar ends -->
        <div class="container header-text">
            <h1 class="header-title">Food<span class="logo-design">Shala</span></h1>
            <p class="header-subtitle">Discover the best food near you <br/> at best price</p>
            <a href="#categoryCard"><button type="button" class="button" >Get started</button></a>
        </div>
    </div>
<!-- End header -->

<!-- contains food categories -->
    <div class="container bg-3  food-category mt-5">
        <h3>Our offered Menu</h3>
        <h2>Some trendy and Populer Food Categories</h2>
        <hr>
        <div class="row " id="categoryCard">
            
        </div>
    </div>
<!-- section ends -->

<!-- veg food items section  -->
    <div class="container bg-3 food-category mt-5">
        <h3>Top veg Items</h3>
        <h2>Some trendy and Populer Veg items</h2>
        <hr>
        <div class="row  menu-list " id="topvegItems">
        </div>
    </div>
<!-- section ends -->

<!-- veg food items section  -->
    <div class="container bg-3 food-category mt-5">
        <h3>Top Non-veg Items</h3>
        <h2>Some trendy and Populer Non-veg items</h2>
        <hr>
        <div class="row  menu-list " id="topnonVegItems">
        </div>
    </div>

<!-- section ends -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/indexscript.js"></script>
</body>

</html>