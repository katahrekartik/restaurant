<?php
// Fooditem controller will be used to make get and post REQUESTs, will work as a mediator between views and models

require_once '../../partials/_dbconnect.php';
require '../models/Fooditem.php';
 
// If the method is get
if ($_SERVER['REQUEST_METHOD'] == "GET"){
    // SWitch between required_data
    $required_data = $_GET['required_data'];
    switch($required_data){
        case 'categories_data':
            $resultData = Fooditem::get_food_categories($conn);
            if($resultData){
                Fooditem::deliver_response(200,"Data found",$resultData);

            }else{
                Fooditem::deliver_response(500,"Data not found",NULL);
            }
        break;
        
        case 'category_food_list':
            $category_id = $_GET['category_id'];
            $resultData = Fooditem::get_category_fooditem_list($category_id,$conn);
            if($resultData){
                Fooditem::deliver_response(200,"Data found",$resultData);

            }else{
                Fooditem::deliver_response(500,"Data not found",NULL);
            }

        break;

        
        case 'foodtype_food_list':
            $foodType = $_GET['food_type_id'];
            $resultData = Fooditem::get_foodtype_fooditem_list($foodType,$conn);
            if($resultData){
                Fooditem::deliver_response(200,"Data found",$resultData);

            }else{
                Fooditem::deliver_response(500,"Data not found",NULL);
            }

        break;

        case 'fooditems':
            $restaurant_id = $_GET['restaurant_id']; 
            $resultData = Fooditem::get_all_fooditems($restaurant_id,$conn);
            if($resultData){
                Fooditem::deliver_response(200,"Data found",$resultData);

            }else{
                Fooditem::deliver_response(500,"Data not found",NULL);
            }
        break;

        case 'food_types':
            $resultData = Fooditem::get_all_foodtypes($conn);
            if($resultData){
                Fooditem::deliver_response(200,"Data found",$resultData);

            }else{
                Fooditem::deliver_response(500,"Data not found",NULL);
            }
        break;

        
        case 'top_veg_items':
            $resultData = Fooditem::get_top_veg_items($conn);
            if($resultData){
                Fooditem::deliver_response(200,"Data found",$resultData);

            }else{
                Fooditem::deliver_response(500,"Data not found",NULL);
            }
        break;

        case 'top_nonveg_items':
        $resultData = Fooditem::get_top_nonveg_items($conn);
        if($resultData){
            Fooditem::deliver_response(200,"Data found",$resultData);

        }else{
            Fooditem::deliver_response(500,"Data not found",NULL);
        }
    break;

        default:
        Fooditem::deliver_response(500,"Invalid request",NULL);

    }

}else if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $submit_name = $_POST['submit_name'];
    switch($submit_name){
        case "addItem":
            $restaurantID =  $_POST['restaurantID'];
            $itemImage =  $_POST['itemImage'];
            $itemName =  $_POST['itemName'];
            $itemPrice =  $_POST['itemPrice'];
            $foodCategory =  $_POST['foodCategory'];
            $foodType =  $_POST['foodType'];
            $itemDescription =  $_POST['itemDescription'];
            $result = Fooditem::insert_food_item($restaurantID,$itemImage,$itemName,$itemPrice,$foodCategory,$itemDescription,$foodType,$conn);
            if($result==1){
                Fooditem::deliver_response(201,"Data inserted",$result);
            }else if($result==1062){
                Fooditem::deliver_response(1062,"Itme with title name already exist",$result);
            }else{
                Fooditem::deliver_response(500,"Internal server error",$result);
            }
        break;

        case 'order_item':
            $fullName =  $_POST['fullName'];
            $contact =  $_POST['contact'];
            $price =  $_POST['price'];
            $address =  $_POST['address'];
            $customerID =  $_POST['customerID'];
            $fooditemID =  $_POST['fooditemID'];
            $itemName = $_POST['itemName'];
            $result = Fooditem::insert_order_details($fullName,$contact,$price,$address,$fooditemID,$customerID,$itemName,$conn);
            if($result==1){
                Fooditem::deliver_response(201,"Data inserted",$result);
            }else if($result==1062){
                Fooditem::deliver_response(1062,"Itme with title name already exist",$result);
            }else{
                Fooditem::deliver_response(500,"Internal server error",$result);
            }
        break;
        default:
            Fooditem::deliver_response(500,"Invalid submit type",NULL);
    }
}else{
    Fooditem::deliver_response(500,"Invalid Method",NULL);
}

?>