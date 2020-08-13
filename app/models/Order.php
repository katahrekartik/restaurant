<?php
//This file contains Order specific functions, will be used for CRUD operations in Order table 
//Order is a child class and can use its parent class functions
require 'Model.php';

class Order extends Model{
 
  

    public function insert_order_details($restaurantID,$fullName,$contact,$price,$address,$fooditemID,$customerID,$itemName,$conn){
        $result = parent::insert_record('orders',['restaurant_id','name','contact_no','total_price','address','customer_id','food_item_id','item_name'],
        [$restaurantID,$fullName,$contact,$price,$address,$customerID,$fooditemID,$itemName],$conn);
        return $result;
    }

    public function get_orders_list($restaurantID,$conn){
        $resultData = parent::get_data_with_selected_columns('orders',['id','name','address','contact_no','item_name','total_price'],"restaurant_id=$restaurantID",$conn);
        return $resultData;
      
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