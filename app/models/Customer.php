<?php
//This file contains customer specific functions, will be used for CRUD operations in customer table 
//Customer is a child class and can use its parent class functions

require 'Model.php';

class Customer extends Model{

    public function check_if_user_exists($username,$conn){
        //Call model class function and with parameters like table name column name and value       
        $result = parent::get_data_with_one_condition('customer','username',$username,$conn);
        if($result==0){
            return false;
        }else{
            return true;
        }
    }


    public function insert_data($username,$email,$password,$user_type,$food_type,$conn){
        //Call parent class function for inserting the data
        $result = parent::insert_record('customer',['username','email','password','role_id','food_type_id'],
        [$username,$email,$password,$user_type,$food_type],$conn);
        return $result;
    }

    public function authanticate_user($table,$username,$password,$conn){
        $result = parent::authanticate_user($table,$username,$password,$conn);
        if($result==0){
            return false;
        }else{
            // Get users data
            $userData = parent::get_data_with_selected_columns('customer',['id','username','email','role_id','food_type_id'],"username='$username'",$conn);
            $roleID = $userData[0]['role_id'];
            $foodtypeID = $userData[0]['food_type_id'];
            //Get role name from role id
            $roleName = parent::get_data_with_selected_columns('user_role',['role_name'],"id='$roleID'",$conn);
            //Get food type name from food type id
            $foodtypeName = parent::get_data_with_selected_columns('food_type',['name'],"id='$foodtypeID'",$conn);
            //Merge users data and additional data
            $additionalData = array('user_type'=>$roleName[0]['role_name'],'food_type'=>$foodtypeName[0]['name']);
            $userDetails = array_merge($userData[0],$additionalData);
            session_start();
            //Create session variables
            $_SESSION["username"] = $userData[0]['username'];
            $_SESSION["user_id"] = $userData[0]['id'];
            $_SESSION['user_type'] = $roleName[0]['role_name'];
            $_SESSION["loggedin"] = true;
            return $userDetails;
        }
    }

     //function for Json response
     public function deliver_response($status,$status_message,$data){
        //http header consist of request from client to server and response from server to client
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