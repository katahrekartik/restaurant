<?php

// Customer controller will be used to make get and post REQUESTs, will work as a mediator between views and models

require_once '../../partials/_dbconnect.php';
require '../models/Customer.php';

$submit_name = $_POST['submit_name'];

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    switch($submit_name){
        case "signup":
                $username = $email = $user_type = $food_type = $password = $confirm_password = "";
                $signup_errors = [];
                // check if username is empty
                if(empty(trim($_POST['username']))){
                    array_push($signup_errors,"Username is empty");
                }else{
                    //Check is user already exists
                    $result = Customer::check_if_user_exists($_POST['username'],$conn);
                    if($result){
                        array_push($signup_errors,"This username is already taken");
                        Customer::deliver_response(1062,"Username already have an account",NULL);
                        exit;
                    }
                    else{
                        $username = trim($_POST['username']);
                    }
                }
                // Checks for password
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
                    Customer::deliver_response(500,$signup_errors,NULL);
                }else{
                    $email = $_POST['email'];
                    $food_type = $_POST['food_type'];
                    $user_type = $_POST['user_type'];
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $result = Customer::insert_data($username,$email,$password,'1',$food_type,$conn);
                    // Customer::deliver_response(201,"Data inserted",$result);
                    Customer::deliver_response(200,"Data inserted",$result); //using 200 instead of 201 for testing purpose
                }
        break;
        case "login":
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $result = Customer::authanticate_user('customer',$username,$password,$conn);
            if($result){
                Customer::deliver_response(200,"User found",$result);

            }else{
                Customer::deliver_response(500,"Invalid username or password",NULL);
            }
        break;
        default:
            Customer::deliver_response(500,"Invalid submit type",NULL);
    }
}else{
    Customer::deliver_response(500,"Invalid Method",NULL);
}

?>