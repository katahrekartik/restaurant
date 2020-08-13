<?php
//This file contains Restaurant specific functions, will be used for CRUD operations in Restaurant table 
//Restaurant is a child class and can use its parent class functions

require 'Model.php';

class Restaurant extends Model{

    public function check_if_user_exists($username,$conn){
        $result = parent::get_data_with_one_condition('restaurant','username',$username,$conn);
        if($result==0){
            return false;
        }else{
            return true;
        }
    }

    public function check_if_restaurant_exists($name,$conn){
         
        $result = parent::get_data_with_one_condition('restaurant','restaurant_name',$name,$conn);
        if($result==0){
            return false;
        }else{
            return true;
        }
    }

    public function insert_data($username,$restaurant_name,$restaurant_address,$user_type,$password,$conn){
        $result = parent::insert_record('restaurant',['username','restaurant_name','restaurant_address','password','role_id'],
        [$username,$restaurant_name,$restaurant_address,$password,$user_type],$conn);
        return $result;
    }

    public function authanticate_user($table,$username,$password,$conn){
        $result = parent::authanticate_user($table,$username,$password,$conn);
        if($result==0){
            return false;
        }else{
            $userData = parent::get_data_with_selected_columns('restaurant',['id','username','restaurant_name','role_id'],"username='$username'",$conn);
            $roleID = $userData[0]['role_id'];
            $roleName = parent::get_data_with_selected_columns('user_role',['role_name'],"id='$roleID'",$conn);
            $additionalData = array('user_type'=>$roleName[0]['role_name']);
            $userDetails = array_merge($userData[0],$additionalData);
            session_start();
            $_SESSION["username"] = $userData[0]['username'];
            $_SESSION["restaurant_name"] = $userData[0]['restaurant_name'];
            $_SESSION["restaurant_id"] = $userData[0]['id'];
            $_SESSION['user_type'] = $roleName[0]['role_name'];
            $_SESSION["loggedin"] = true;
            return $userData;
        }
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