<?php
// Orders controller will be used to make get and post REQUESTs, will work as a mediator between views and models

require_once '../../partials/_dbconnect.php';

require '../models/Order.php';

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    $required_data = $_GET['required_data'];
    switch($required_data){
        case 'orders_list':
            $restaurantID = $_GET['restaurant_id'];
            $resultData = Order::get_orders_list($restaurantID,$conn);
            if($resultData){
                Order::deliver_response(200,"Data found",$resultData);

            }else{
                Order::deliver_response(500,"Data not found",NULL);
            }
        break;
        
        default:
        Order::deliver_response(500,"Invalid request",NULL);

    }
}else if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $submit_name = $_POST['submit_name'];
    switch($submit_name){
        case 'order_item':
            $restaurantID =  $_POST['restaurantID'];
            $fullName =  $_POST['fullName'];
            $contact =  $_POST['contact'];
            $price =  $_POST['price'];
            $address =  $_POST['address'];
            $customerID =  $_POST['customerID'];
            $fooditemID =  $_POST['fooditemID'];
            $itemName = $_POST['itemName'];
            $result = Order::insert_order_details($restaurantID,$fullName,$contact,$price,$address,$fooditemID,$customerID,$itemName,$conn);
            if($result==1){
                Order::deliver_response(201,"Data inserted",$result);
            }else if($result==1062){
                Order::deliver_response(1062,"Itme with title name already exist",$result);
            }else{
                Order::deliver_response(500,"Internal server error",$_POST);
            }
        break;
        default:
            Order::deliver_response(500,"Invalid submit type",NULL);
    }
}else{
    Order::deliver_response(500,"Invalid Method",NULL);
}


?>