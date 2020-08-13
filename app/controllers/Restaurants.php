<?php
// Fooditem Restaurant will be used to make get and post REQUESTs, will work as a mediator between views and models

require_once '../../partials/_dbconnect.php';
require '../models/Restaurant.php';

$submit_name = $_POST['submit_name'];

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    switch($submit_name){
        case "signup":
                $username = $restaurant_name = $user_type = $restaurant_address = $password = $confirm_password = "";
                $signup_errors = [];
                $result = Restaurant::check_if_user_exists($_POST['username'],$conn);
                if($result){
                    array_push($signup_errors,"This username is already taken");
                    Restaurant::deliver_response(1062,"Username already have an account",$_POST);
                    exit;
                }
                else{
                    $username = trim($_POST['username']);
                }
                $resultRes = Restaurant::check_if_restaurant_exists($_POST['restaurantName'],$conn);
                if($resultRes){
                    array_push($signup_errors,"This Restaurant Name is already taken");
                    Restaurant::deliver_response(1062,"This Restaurant Name is already taken",NULL);
                    exit;
                }
                else{
                    $restaurant_name = trim($_POST['restaurant_name']);
                }
                // Check for password
                if(empty(trim($_POST['password']))){
                    array_push($signup_errors,"Password cannot be blank");
                }
                elseif(strlen(trim($_POST['password'])) < 5){
                    array_push($signup_errors,"Password cannot be less than 5 characters");
                }
                else{
                    $password = trim($_POST['password']);
                }
                // Check for confirm password field
                if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
                    array_push($signup_errors,"Passwords should match");
                }

                // If there were no errors, go ahead and insert into the database
                if(count($signup_errors)>0){
                    // print_r($signup_errors);  
                    Restaurant::deliver_response(500,$signup_errors,NULL);
                }else{
                    $restaurant_name = $_POST['restaurantName'];
                    $restaurant_address = $_POST['restaurantAddress'];
                    $user_type = $_POST['user_type'];
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $result = Restaurant::insert_data($username,$restaurant_name,$restaurant_address,'2',$password,$conn);
                    // header('location:../../index.php');
                    Restaurant::deliver_response(200,"Data inserted",$result);
                }
        break;
        case "login":
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $result = Restaurant::authanticate_user('restaurant',$username,$password,$conn);
            if($result){
                Restaurant::deliver_response(200,"User found",$result);

            }else{
                Restaurant::deliver_response(500,"Invalid username or password",NULL);
            }
        break;
        default:
            Restaurant::deliver_response(500,"Invalid submit type",NULL);
    }
}else{
    Restaurant::deliver_response(500,"Invalid Method",NULL);
}

?>