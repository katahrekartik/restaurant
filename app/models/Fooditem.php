<?php
//This file contains Fooditem specific functions, will be used for CRUD operations in Fooditem table 
//Fooditem is a child class and can use its parent class functions

require 'Model.php';

class Fooditem extends Model{

    public function get_food_categories($conn){
        $resultData = parent::get_data_with_selected_columns('categories',['id','category_name','category_image'],'',$conn);
        return $resultData;
    }

    public function get_category_fooditem_list($category_id,$conn){
        $resultData = parent::get_data_with_inner_join_in_three_tables(
            ['food_item','restaurant','categories'],
            ['id','item_name','food_image','description','price','category_id','food_type_id','restaurant_id'],
            ['id','restaurant_name','restaurant_address'],
            ['id','category_name'],['restaurant_id','category_id','id','id'],"category_id=$category_id",$conn);
        return $resultData;
    }
    
    public function get_foodtype_fooditem_list($foodType,$conn){
        $resultData = parent::get_data_with_inner_join_in_three_tables(
            ['food_item','restaurant','food_type'],
            ['id','item_name','food_image','description','price','category_id','food_type_id','restaurant_id'],
            ['id','restaurant_name','restaurant_address'],
            ['id','name'],['restaurant_id','food_type_id','id','id'],"food_type_id= $foodType",$conn);
        return $resultData;
    }

    public function get_all_fooditems($restaurant_id,$conn){
        $resultData = parent::get_data_with_inner_join_in_three_tables(
            ['food_item','food_type','categories'],
            ['id','item_name','price','description','food_image'],
            ['id','name'],
            ['id','category_name'],['food_type_id','category_id','id','id'],"restaurant_id=$restaurant_id",$conn);
        return $resultData;

    }


    public function get_all_foodtypes($conn){
        $resultData = parent::get_data_with_selected_columns('food_type',['id','name'],'',$conn);
        return $resultData;

    }

    public function get_top_veg_items($conn){
        $resultData = parent::get_data_with_inner_join_in_two_tables(
            ['food_item','food_type'],
            ['id','item_name','food_image','description','price','category_id','food_type_id'],
            ['name'],['food_type_id','id'],"food_type_id = 1 LIMIT 4",$conn);
        return $resultData;
    }

    
    public function get_top_nonveg_items($conn){
        $resultData = parent::get_data_with_inner_join_in_two_tables(
            ['food_item','food_type'],
            ['id','item_name','food_image','description','price','category_id','food_type_id'],
            ['name'],['food_type_id','id'],"food_type_id = 2 LIMIT 4",$conn);
        return $resultData;
    }

    public function insert_food_item($restaurantID,$itemImage,$itemName,$itemPrice,$foodCategory,$itemDescription,$foodType,$conn){
        $result = parent::insert_record('food_item',['restaurant_id','item_name','description','food_image','category_id','food_type_id','price'],
        [$restaurantID,$itemName,$itemDescription,$itemImage,$foodCategory,$foodType,$itemPrice],$conn);
        return $result;
    }

   
     //function for Json response
     public function deliver_response($status,$status_message,$data){
        //http header consist of request from client to server and response from server to client
        // header("HTTP/1.1 $status $status_message");
        //variable stores status code, message and returned data
        $response['status'] = $status;
        $response['status_message'] = $status_message;
        $response['data'] = $data;
        //Encode messgae in a variable
        $json_response = json_encode($response);
        //Print Response
        echo $json_response;
    }
}

?>