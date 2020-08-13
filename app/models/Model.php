<?php

// This file contains some general function for create, update, get and delete the data from the database
// that will be used by the controllers

class Model{
    //function for get record with one condition
    protected function get_data_with_one_condition($table,$column,$value,$conn){
        $query_for_select = "SELECT * FROM $table WHERE $column = ?"; 
        //Prepare statement to prevent from sql injections
        $stmt = mysqli_prepare($conn, $query_for_select);
        if($stmt)
        {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set the value of param username
            $param_username = trim($value);
            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if ($result->num_rows > 0) {
                    //Store in data array
                    while($row = mysqli_fetch_assoc($result)) {
                        $data[] = $row;
                    }
                    // return Data
                    return $data;
                }
                else{
                    return 0;
                }
            }
            else{
                return 0;
            }
        }
        // mysqli_stmt_close($stmt);
    }

     //Function for insert records in the database
     protected function insert_record($table,$columns,$values,$conn){
        // initiate couln and values string for creating the query for insert
        $column_strings = '';
        $values_string = '';
     
        //Append comma after the each elemets of columns array and each elements of values within single quotes 
        for($i=0;$i<sizeof($columns);$i++){
            
            //If Last element than skip comma 
            if($i==sizeof($columns)-1){
                $column_strings = $column_strings.$columns[$i];
                //If value is null append null
                if($values[$i]==NULL){
                    $values_string = $values_string.'NULL';
                }else{//else append value
                    $values_string = $values_string.'"'.$values[$i].'"';
                }
            }
            else{//else create coulmn and values statements and append comma after each elements
                $column_strings = $column_strings.$columns[$i].',';                
                if($values[$i]==NULL){
                    $values_string = $values_string.'NULL'.',';
                }else{//else append value
                    $values_string = $values_string.'"'.$values[$i].'"'.',';
                }
            }   
        }
        //query for insert the data
        $query_for_insert = "INSERT INTO $table ($column_strings) VALUES ($values_string)";
        // echo $query_for_insert;
        if (mysqli_query($conn, $query_for_insert)) {//If data inserted successfully
            
            return 1;
        } 
        else {//If data in not inserted
            $error = mysqli_error($conn);
            $errno = mysqli_errno($conn);
            return $errno;
        }
        
    }

    //Function for authanticate the user
    protected function authanticate_user($table,$username,$password,$conn){
        // query for statement
        $query_for_select = "SELECT id, username, password FROM $table WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query_for_select);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            // store result
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    // varify password
                    if(password_verify($password, $hashed_password)){
                        return 1;
                    }else{
                        return 0;
                    }
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }


     //function for get selected record with one condition, Multiple condition or without where clause
     protected function get_data_with_selected_columns($table,$selectedCoulmns,$conditionString,$conn){
        //Create selected column string
        $selectedString = '';
        //Creating string using each elements of columns and values array        
        for($i=0;$i<sizeof($selectedCoulmns);$i++){
            //If last element than skip appending comma
            if($i==sizeof($selectedCoulmns)-1){
                $selectedString = $selectedString.$selectedCoulmns[$i];
            }
            else{//else generate update statement string
                $selectedString = $selectedString.$selectedCoulmns[$i].',';
            }   
        }
        //If condition string is not null create query with condition string
        if($conditionString!=''){
            $query_for_select = "SELECT $selectedString FROM $table WHERE $conditionString"; 
        }else{
            $query_for_select = "SELECT $selectedString FROM $table"; 
        }
        
        $result_for_select = $conn->query($query_for_select);
        // echo $query_for_select;
        //Check if data exists 
        if ($result_for_select->num_rows > 0) {
            //Store in data array
            while($row = $result_for_select->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        else{
            $error = mysqli_error($conn);
            return 0;
        }
    }


    
    //Function for select data with three tables using joins
    protected function get_data_with_inner_join_in_two_tables($tables,$table1Columns,$table2Columns,$ids,$conditionString,$conn){
        
            
        //Initiate strnig variable for creating select string and tables string statement 
        $table1ColumnString = '';
        $table2ColumnString = '';
        
        //Creating string for Columns for select for table 2(not pivot table)
        for($i=0;$i<sizeof($table2Columns);$i++){
            //Create string for table 2 Columns
            $table2ColumnString = $table2ColumnString.$tables[1].'.'.$table2Columns[$i].',';
        }
        //Creating string for Columns for select for table 1(pivot table)
        for($i=0;$i<sizeof($table1Columns);$i++){
            //Create string for table 1 pivot table columns
            if($i==sizeof($table1Columns)-1){
                //If last element skip appending comma
                $table1ColumnString = $table1ColumnString.$tables[0].'.'.$table1Columns[$i];

            }else{
                //Else create string and append comma after each element of the array
                $table1ColumnString = $table1ColumnString.$tables[0].'.'.$table1Columns[$i].',';
        
            }
            
        }
        //store table1(pivot),table2(non-pivot) and table3(non-pivot) in variables
        $table1 = $tables[0];
        $table2 = $tables[1];
        //Stores ids in variables
        $column1 = $ids[0];
        $column2 = $ids[1];

        //query for select data from database
        $query_for_select = "SELECT $table2ColumnString $table1ColumnString FROM $table1 INNER JOIN $table2 ON $table1.$column1 = $table2.$column2 WHERE $conditionString"; 
    //  echo $query_for_select;
        //Store data in result
        $result_for_select = $conn->query($query_for_select);  
        if ($result_for_select->num_rows > 0) {//IF data exist store in a data array and return 
            while($row = $result_for_select->fetch_assoc()) {
                $data[] = $row;
            }
           
            return $data;
        }
        else{// else return 0            
          
            return '0';
        }
        
    }


    
       //Function for select data with three tables using joins
       function get_data_with_inner_join_in_three_tables($tables,$table1Columns,$table2Columns,$table3Columns,$ids,$conditionString,$conn){     
        //Initiate strnig variable for creating select string and tables string statement 
        $table1ColumnString = '';
        $table3ColumnString = '';
        $table2ColumnString = '';
        //Creating string for Columns for select for table 2(not pivot table)
        for($i=0;$i<sizeof($table2Columns);$i++){
            //Create string for table 2 Columns
            $table2ColumnString = $table2ColumnString.$tables[1].'.'.$table2Columns[$i].',';
        }
        //Creating string for Columns for select for table 3(non pivot table)
        for($i=0;$i<sizeof($table3Columns);$i++){
            //Create string for table 3 Columns
            $table3ColumnString = $table3ColumnString.$tables[2].'.'.$table3Columns[$i].',';
        }
        //Creating string for Columns for select for table 1(pivot table)
        for($i=0;$i<sizeof($table1Columns);$i++){
            //Create string for table 1 pivot table columns
            if($i==sizeof($table1Columns)-1){
                //If last element skip appending comma
                $table1ColumnString = $table1ColumnString.$tables[0].'.'.$table1Columns[$i];

            }else{
                //Else create string and append comma after each element of the array
                $table1ColumnString = $table1ColumnString.$tables[0].'.'.$table1Columns[$i].',';
        
            }
            
        }
        //store table1(pivot),table2(non-pivot) and table3(non-pivot) in variables
        $table1 = $tables[0];
        $table2 = $tables[1];
        $table3 = $tables[2];
        //Stores ids in variables
        $column1 = $ids[0];
        $column2 = $ids[1];
        $column3 = $ids[2];
        $column4 = $ids[3];
 
        //query for select data from database
        $query_for_select = "SELECT $table2ColumnString $table3ColumnString $table1ColumnString FROM (($table2 INNER JOIN $table1 ON $table1.$column1 = $table2.$column3) INNER JOIN $table3 ON $table1.$column2 = $table3.$column4) WHERE $conditionString"; 
        //Store data in result
        $result_for_select = $conn->query($query_for_select);  
        if ($result_for_select->num_rows > 0) {//IF data exist store in a data array and return 
            while($row = $result_for_select->fetch_assoc()) {
                $data[] = $row;
            }
           
            return $data;
        }
        else{// else return 0            
            $error = mysqli_error($conn);
          
            return 0;
        }
        
    }



}

?>